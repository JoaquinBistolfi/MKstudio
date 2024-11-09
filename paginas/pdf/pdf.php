<?php
include '../../includes/conexion.php';
require('fpdf186/fpdf.php');


$lote_id = $_GET['id'];
$sql = "
    SELECT 
        l.categoria, 
        l.raza, 
        l.cantidad, 
        l.peso_promedio, 
        o.monto, 
        u.nombre,
        u.apellido 
    FROM 
        lotes l 
    JOIN 
        oferta o ON o.id_lote = l.id_lote 
    JOIN 
        usuarios u ON u.id_usuario = o.id_usuario 
    WHERE 
        l.id_lote = '$lote_id'
    ORDER BY 
        o.monto DESC 
    LIMIT 1;
";
$result = mysqli_query($conexion, $sql);
$lote = mysqli_fetch_assoc($result);

$pdf = new FPDF('PORTRAIT', 'cm', [21.5, 14]);
$pdf->AddPage();
$pdf->SetFont('Arial', 'B', 12);
$pdf->SetFillColor(220, 220, 220);
$pdf->Cell(12, 1, 'Nota de Venta', 1, 1, 'C', true);
$pdf->Ln(0.5);

$pdf->Image('darosa.png', 1, 3, 6, 0, 'png');
$pdf->SetFont('Arial','B',10);
$pdf->SetXY(8, 3.2);
$pdf->Cell(0, 0.5, "Da Rosa SRL");
$pdf->SetFont('Arial','',10);
$pdf->SetXY(8, 3.9);
$pdf->Cell(0, 0.5, "Amorin 583");
$pdf->SetXY(8, 4.6);
$pdf->Cell(0, 0.5, "Telefono: 091786564 / 47340024");
$pdf->SetXY(8, 5.3);
$pdf->Cell(0, 0.5, "darosa@gmail.com");

$pdf->SetFont('Arial', '', 10);
$pdf->Ln(1.5);
$pdf->Cell(0, 0.5, "Comprador: " . $lote['nombre'] . ' ' . $lote['apellido'], 0, 1);
$pdf->Cell(0, 0.5, "Fecha: " . date('d/m/Y'), 0, 1);
$pdf->Ln(0.5);

$pdf->SetFont('Arial', 'B', 10);
$pdf->Cell(2.5, 0.7, 'Cantidad', 1, 0, 'C');
$pdf->Cell(6, 0.7, utf8_decode('Descripción'), 1, 0, 'C');
$pdf->Cell(3.5, 0.7, 'Precio unitario', 1, 0, 'C');
$pdf->Ln(0.7);

$pdf->SetFont('Arial', '', 10);
$pdf->Cell(2.5, 0.7, $lote['cantidad'], 1, 0, 'C');
$pdf->Cell(6, 0.7, $lote['categoria'], 1, 0, 'C');
$pdf->Cell(3.5, 0.7, '$' . $lote['monto'] * $lote['peso_promedio'], 1, 1, 'C');

$pdf->Ln(0.5);
$total = $lote['cantidad'] * $lote['peso_promedio'] * $lote['monto'];
$pdf->Cell(8.5, 0.7, 'Total a pagar:', 1, 0, 'R');
$pdf->Cell(3.5, 0.7, '$' . number_format($total, 2), 1, 1, 'C');
$pdf->Ln(0.5);

$pdf->SetFont('Arial', 'I', 8);
$pdf->Cell(0, 1, '*Este documento no es una factura fiscal certificada por la DGI.', 0, 1, 'C');
$pdf->Output();
?>
