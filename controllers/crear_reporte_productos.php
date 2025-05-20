<?php
require("pdf.php"); // Archivo en la raíz
require_once("../models/MySQL.php"); // Carpeta models en la raíz

$mysql = new MySQL();
$mysql->conectar();
$consulta_productos = "SELECT id, nombre, descripcion, precio, stock, Estado
FROM productos";
$resultado = $mysql->efectuarConsulta($consulta_productos);
$datos_productos = [];
if ($resultado) {
    while ($producto = $resultado->fetch_assoc()) {
        $datos_productos[] = $producto;
    }
    $resultado->free();
} else {
    echo "Error al obtener los productos";
    exit;
}
// Crear instancia
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Arial', '', 12);
// Titulo
$pdf->SetFont('Arial', 'B', 16);
$pdf->Cell(0, 10, 'Reporte de productos', 0, 1, 'C');
$pdf->Ln(5);
// Fecha de creacion
$fecha_creacion = date('Y-m-d H:i:s');
$pdf->SetFont('Arial', 'I', 10);
$pdf->Cell(0, 10, 'Fecha de Creacion: ' . $fecha_creacion, 0, 1, 'R');
$pdf->Ln(10);
// Encabezados
$header = ['ID', 'Nombre', 'Descripcion', 'Precio', 'Stock', 'Estado'];
$pdf->CrearTablaProductos($header, $datos_productos);
$pdf->Output("reporte_productos.pdf", "I"); // Cambia 'I' a 'D' para descargar el archivo
$mysql->desconectar();
?>