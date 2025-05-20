<?php
session_start();
require_once '../models/MySQL.php';

$mysql = new MySQL;
$mysql->conectar();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    //verificamos la existencia de los campos
    if (isset($_POST['usuario_id'], $_POST['total_pedido'], $_POST['productos_ocultos'])) {

        //obtenemos los datos del formulario antes de validar o sanitizar
        $idUsuario = trim($_POST['usuario_id']);
        $totalPedido = trim($_POST['total_pedido']);
        $productos = json_decode($_POST['productos_ocultos']);

        if (empty($idUsuario) || empty($totalPedido) || empty(($productos))) {
            echo "Por favor, complete todos los campos.";
            header("Location: ../views/carrito.php?error=102");
            exit();
        }

        //insertar en base de datos 
        $consulta = "INSERT INTO pedidos 
            (usuario_id, fecha, total)
            VALUES 
            ('$idUsuario', NOW(), '$totalPedido')";
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
?>