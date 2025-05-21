<?php

require("../vendor/fpdf186/fpdf.php");

class PDF extends FPDF
{
    function Header()
    {
        $this->Image('../images/Logo_Lenteja.png', 10, 10, 30); // Reemplaza con la ruta real de tu logo
        $this->SetFont('Arial', 'B', 15);
        $this->Cell(40);
        $this->Cell(50, 10, 'Reporte de Productos', 0, 0, 'C');
        $this->Ln(20);
    }

    function Footer()
    {
        $this->SetY(-15);
        $this->SetFont('Arial', 'I', 8);
        $this->Cell(0, 10, 'Página ' . $this->PageNo() . '/{nb}', 0, 0, 'C');
    }

    function CrearTablaProductos($header, $data)
    {
        // Colores de los encabezados
        $this->SetFillColor(48, 129, 204); // Azul
        $this->SetTextColor(255);
        $this->SetDrawColor(48, 129, 204);
        $this->SetLineWidth(.3);
        $this->SetFont('', 'B');

        // Cabecera
        $w = array(20, 40, 60, 25, 20, 25); // sin imagen // Anchos de las columnas
        for ($i = 0; $i < count($header); $i++)
            $this->Cell($w[$i], 7, $header[$i], 1, 0, 'C', true);
        $this->Ln();

        // Restauración de colores y fuentes
        $this->SetFillColor(224, 235, 255);
        $this->SetTextColor(0);
        $this->SetFont('');

        // Datos
        $fill = false;
        foreach ($data as $row) {
            $this->Cell($w[0], 6, $row['id'], 'LR', 0, 'C', $fill);
            $this->Cell($w[1], 6, $row['nombre'], 'LR', 0, 'L', $fill);

            // Recortar descripción si es muy larga
            $descripcion = (strlen($row['descripcion']) > 30) ?
                substr($row['descripcion'], 0, 27) . '...' :
                $row['descripcion'];
            $this->Cell($w[2], 6, $descripcion, 'LR', 0, 'L', $fill);

            $this->Cell($w[3], 6, '$' . number_format($row['precio'], 0, ',', '.'), 'LR', 0, 'R', $fill);
            $this->Cell($w[4], 6, $row['stock'], 'LR', 0, 'C', $fill);

            // Estado como texto
            $estado = ($row['Estado'] == 'ACTIVO') ? 'Activo' : 'Inactivo';
            $this->Cell($w[5], 6, $estado, 'LR', 0, 'C', $fill);


            $this->Ln();
            $fill = !$fill;
        }

        // Línea de cierre
        $this->Cell(array_sum($w), 0, '', 'T');
    }
}
