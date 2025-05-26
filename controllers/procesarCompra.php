<?php
session_start();
require_once '../models/MySQL.php';

$mysql = new MySQL;
$mysql->conectar();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    //verificamos la existencia de los campos
    if (isset($_POST['usuario_id'], $_POST['total_pedido'], $_POST['productos_ocultos'])) {

        //obtenemos los datos del formulario antes de validar o sanitizar
        // Sanitizar y validar idUsuario (números enteros positivos)
        $idUsuario = trim($_POST['usuario_id']);
        if (!preg_match('/^\d+$/', $idUsuario)) {
            die("ID de usuario no válido");
        }

        // Sanitizar y validar totalPedido (número decimal con 2 decimales opcionales)
        $totalPedido = trim($_POST['total_pedido']);
        if (!preg_match('/^\d+(\.\d{1,2})?$/', $totalPedido)) {
            die("Total del pedido no válido");
        }

        // Sanitizar y validar productos (debe ser un JSON válido y un array)
        $productosRaw = $_POST['productos_ocultos'];
        $productos = json_decode($productosRaw);
        if (!is_array($productos)) {
            die("Formato de productos no válido");
        }

        // Sanitizar y validar dirección (solo letras, números, espacios y ciertos símbolos)
        $direccion = trim($_POST['direccion_envio']);
        if (!preg_match('/^[\p{L}\d\s\-,.#]+$/u', $direccion)) {
            die("Dirección de envío no válida");
        }

        if (empty($idUsuario) || empty($totalPedido) || empty(($productos)) || empty(($direccion))) {
            echo "Por favor, complete todos los campos.";
            header("Location: ../views/carrito.php?error=102");
            exit();
        }

        //confirmar el stock y la existencia del producto antes de insertar
        foreach ($productos as $producto) {
            $idProducto = $producto->id;
            $cantidad = $producto->cantidad;

            $procedure = "CALL verificar_stock($idProducto, $cantidad, @estado_compra, @existencia_producto)";
            $mysql->efectuarConsulta($procedure);

            $respuesta = $mysql->efectuarConsulta("SELECT @estado_compra AS estado, @existencia_producto AS existe");
            $verificacion = mysqli_fetch_assoc($respuesta);

            if (!$verificacion['existe']) {
                // Producto no existe
                $mysql->desconectar();
                header("Location: ../views/carrito.php?error=Producto no existe (ID $idProducto)");
                exit();
            }

            if (!$verificacion['estado']) {
                // Stock insuficiente
                $mysql->desconectar();
                header("Location: ../views/carrito.php?error=Stock insuficiente para producto ID $idProducto");
                exit();
            }
        }


        //insertar en base de datos 
        $consulta = "INSERT INTO pedidos 
            (usuario_id, fecha, total, direccion_envio)
            VALUES 
            ('$idUsuario', NOW(), '$totalPedido', '$direccion')";
        $mysql->efectuarConsulta($consulta);

        //actualizar direccion del cliente
        $consulta = "UPDATE usuarios SET direccion = '$direccion' WHERE id = $idUsuario";
        $mysql->efectuarConsulta($consulta);

        $consulta = "SELECT MAX(id) as ultimo_id FROM pedidos";
        $resultado = $mysql->traerUltimoId($consulta);
        $fila = mysqli_fetch_assoc($resultado);
        $idPedido = $fila['ultimo_id'];


        foreach ($productos as $producto) {
            $idProducto = $producto->id;
            $cantidad = $producto->cantidad;
            $precio = $producto->precio;
            $consulta = "INSERT INTO detalles_pedido 
            (pedido_id, producto_id, cantidad, precio_unitario)
            VALUES 
            ('$idPedido', '$idProducto', '$cantidad', '$precio')";

            $mysql->efectuarConsulta($consulta);
        }

        $mysql->desconectar();
        header("Location: ../index.php");
        exit();
    } else {
        header("Location: ../views/carrito.php?error=102");
        exit();
    }
} else {
    echo "Metodo de envio invalido";
    header("Location: ../views/carrito.php?error=102");
    exit();
}
