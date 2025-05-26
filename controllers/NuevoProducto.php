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

        //Esta funcion devuelve un array con los datos del formulario (EVITA QUE SE PIERDAN LOS DATOS SI HAY UN ERROR)
    function InfoFormulario() {
    return [
        'nombre' => $_POST['nombre'] ?? '',
        'descripcion' => $_POST['descripcion'] ?? '',
        'precio' => $_POST['precio'] ?? '',
        'stock' => $_POST['stock'] ?? ''
    ];
}

    if (empty($nombre) && empty($descripcion) && empty($precio) && empty($stock)) {
        header("Location: ../admin/NuevoProducto.php?error=99");
        exit();
    }

    if (empty($nombre)) {
    $datos = http_build_query(array_merge([
        'error' => 'nombre_vacio'],InfoFormulario()));
    header("Location: ../admin/NuevoProducto.php?" . $datos);
    exit();
    }
    if (empty($descripcion)) {
        $datos = http_build_query(array_merge([
            'error' => 'descripcion_vacio'],InfoFormulario()));
        header("Location: ../admin/NuevoProducto.php?" . $datos);
        exit();
    }
    if (empty($precio) || $precio < 0) {
        $datos = http_build_query(array_merge([
            'error' => 'precio_vacio'],InfoFormulario()));
        header("Location: ../admin/NuevoProducto.php?" . $datos);
        exit();
    }
    if (empty($stock) || $stock < 0) {
        $datos = http_build_query(array_merge([
            'error' => 'stock_vacio'],InfoFormulario()));
        header("Location: ../admin/NuevoProducto.php?" . $datos);
        exit();
    }
    

    if (isset($_FILES['imagen']) && $_FILES['imagen']['error'] === UPLOAD_ERR_OK) {
        $permitidos = ['image/jpeg' => '.jpg', 'image/png' => '.png'];
        $tipo = mime_content_type($_FILES['imagen']['tmp_name']);

        if (!array_key_exists($tipo, $permitidos)) {
            $datos = http_build_query(array_merge([
                'error' => '88'],InfoFormulario()));
            header("Location: ../admin/NuevoProducto.php?" . $datos);
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
            $datos = http_build_query(array_merge([
                'error' => '87'],InfoFormulario()));
            header("Location: ../admin/NuevoProducto.php?" . $datos);
            exit();
        }
    } else {
        $datos = http_build_query(array_merge([
            'error' => '86'],InfoFormulario()));
        header("Location: ../admin/NuevoProducto.php?" . $datos);
        exit();
    }

} else {
    echo "No se ha enviado el formulario.";
}
