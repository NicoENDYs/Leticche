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
    $estado = trim(filter_input(INPUT_POST, 'Estado', FILTER_SANITIZE_FULL_SPECIAL_CHARS));

    if (empty($nombre) || empty($descripcion) || empty($precio) || empty($stock)) {
        echo "Por favor, complete todos los campos.";
        exit;
    }

    //Consulta sin la imagen
    $consulta = "UPDATE productos SET 
    nombre = '$nombre', 
    descripcion = '$descripcion', 
    precio = '$precio', 
    stock = '$stock', 
    Estado = '$estado'";


    if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
        $permitidos = ['image/jpeg' => '.jpg', 'image/png' => '.png'];
        $tipo = mime_content_type($_FILES['imagen']['tmp_name']);

        if (!array_key_exists($tipo, $permitidos)) {
            die("Solo se permiten imágenes JPG y PNG.");
        }

        $extension = $permitidos[$tipo];
        $nombreImagen = uniqid('producto_') . $extension;
        $rutaDestino = '../img/' . $nombreImagen;

        if (move_uploaded_file($_FILES['imagen']['tmp_name'], $rutaDestino)) {
            //Consulta si hay imagen
            $consulta .= ", imagen = '$nombreImagen'";
        } else {
            echo "Error al guardar la imagen.";
            exit;
        }
    }
    
    $consulta .= " WHERE id = {$_POST['id']}";

    //hacer la consulta
    $mysql->efectuarConsulta($consulta);
    echo "Producto editado con éxito";

    $mysql->desconectar();
    header("Location: ../admin/admin_productos.php");
    exit();
} else {
    echo "No se ha enviado el formulario.";
}
