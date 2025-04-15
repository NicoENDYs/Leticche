<?php
require_once '../models/MySQL.php';

$mysql = new MySQL;
$mysql->conectar();



// Obtener el ID del empleado a eliminar

$id = isset($_GET['id']) ? filter_var($_GET['id'], FILTER_VALIDATE_INT) : false;

// Verificar si el ID es válido
if ($id === false || $id <= 0) {
    echo "ID no válido.";
    exit;
}
// Construir la consulta SQL para """"ELIMINAR"""" el empleado

$consulta = "Update usuarios set Estado = 'INACTIVO' where id = '$id'";
// Ejecutar la consulta
$mysql-> efectuarConsulta($consulta);

$mysql->desconectar();
// Redirigir a la página de dashboard después de eliminar el empleado
header("Location: ../admin/admin_dashboard.php");
exit();

?>