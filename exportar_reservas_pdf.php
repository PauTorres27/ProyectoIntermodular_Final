<?php
require("fpdf/fpdf.php");
require("conexion.php");

//Crear PDF
$pdf = new FPDF();
$pdf-> AddPage();
$pdf->SetFont("Arial", "B", 16);

//Titulo
$pdf->Cell(0, 10, "Listado de Reservas", 0, 1, "C");
$pdf->Ln(5);

//Encabezados de tabla
$pdf->SetFont("Arial", "B", 12);
$pdf->Cell(30, 10, "ID", 1);
$pdf->Cell(50, 10, "Usuario", 1);
$pdf->Cell(40, 10, "Fecha", 1);
$pdf->Cell(30, 10, "Personas", 1);
$pdf->Cell(40, 10, "Mesa", 1);
$pdf->Ln();

//Datos
$pdf->SetFont("Arial", "", 12);

$sql = "SELECT r.id, u.nombre, r.fecha, r.n_personas, r.id_mesa
        FROM reservas r
        JOIN usuarios u ON r.id_usuario = u.id";

$resultado = $conexion->query($sql);

while ($fila = $resultado->fetch_assoc()) {
    $pdf->Cell(30, 10, $fila["id"], 1);
    $pdf->Cell(50, 10, $fila["nombre"], 1);
    $pdf->Cell(40, 10, $fila["fecha"], 1);
    $pdf->Cell(30, 10, $fila["n_personas"], 1);
    $pdf->Cell(40, 10, $fila["id_mesa"], 1);
    $pdf->Ln();
}

$pdf->Output();
?>
