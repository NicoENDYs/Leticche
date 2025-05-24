<?php
require_once '../models/MySQL.php';

$mysql = new MySQL;
$mysql->conectar();



// Obtener el ID del pedido a modificar
$id = isset($_POST['id_pedido']) ? filter_var($_POST['id_pedido'], FILTER_VALIDATE_INT) : false;
$estado = !empty($_POST["estado_pedido"]) ? $_POST["estado_pedido"] : "Error";

// Verificar si el ID es válido
if ($id === false || $id <= 0) {
    echo "ID no válido.";
    exit;
}
// Construir la consulta SQL para """"ACTUALIZAR"""" el pedido

$consulta = "UPDATE pedidos set estado = '$estado' where id = '$id'";
// Ejecutar la consulta
$mysql-> efectuarConsulta($consulta);

$mysql->desconectar();
// Redirigir a la página de dashboard después de actualizar el pedido
header("Location: ../admin/admin_pedidos.php");
exit();

?>