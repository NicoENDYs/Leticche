<?php
require_once '../models/MySQL.php';

$mysql = new MySQL;
$mysql->conectar();

if (
    $_SERVER['REQUEST_METHOD'] == 'POST'
    && isset($_POST['Enviar'])
) {

    $nombre = trim(filter_input(INPUT_POST, 'nombre', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
    $descripcion = trim(filter_input(INPUT_POST, 'descripcion', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
    $precio = trim(filter_input(INPUT_POST, 'precio', FILTER_VALIDATE_FLOAT));
    $stock = trim(filter_input(INPUT_POST, 'stock', FILTER_VALIDATE_INT));
    $estado = 'ACTIVO';

    if (empty($nombre) || empty($descripcion) || empty($precio) || empty($stock)) {
        header("Location: ../admin/NuevoProducto.php?error=99");
        exit();
    }

    if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
        $permitidos = ['image/jpeg' => '.jpg', 'image/png' => '.png'];
        $tipo = mime_content_type($_FILES['imagen']['tmp_name']);

        if (!array_key_exists($tipo, $permitidos)) {
            header("Location: ../admin/NuevoProducto.php?error=88");
            exit();
        }
        
        $extension = $permitidos[$tipo];
        $nombreImagen = uniqid('producto_') . '.' . $extension;
        $rutaDestino = '../img/' . $nombreImagen;


        if (move_uploaded_file($_FILES['imagen']['tmp_name'], $rutaDestino)) {

            $consulta = "INSERT INTO productos 
            (nombre, descripcion, precio, stock, Estado, imagen)
            VALUES 
            ('$nombre', '$descripcion', '$precio', '$stock', '$estado', '$nombreImagen')";
            $mysql->efectuarConsulta($consulta);
            echo "producto creado con exito";

            //insertar en base de datos 

            $mysql->desconectar();
            header("Location: ../admin/admin_productos.php?exito=100");
            exit();

        } else {
            header("Location: ../admin/NuevoProducto.php?error=87");
            exit();
        }
    } else {
        header("Location: ../admin/NuevoProducto.php?error=86");
            exit();
    }

} else {
    echo "No se ha enviado el formulario.";
}
