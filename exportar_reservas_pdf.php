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
$pdf->Cell(20, 10, "ID", 1);
$pdf->Cell(40, 10, "Usuario", 1);
$pdf->Cell(30, 10, "Fecha", 1);
$pdf->Cell(25, 10, "Hora", 1);
$pdf->Cell(25, 10, "Personas", 1);
$pdf->Cell(25, 10, "Mesa", 1);
$pdf->Cell(25, 10, "Estado", 1);
$pdf->Ln();

//Datos
$pdf->SetFont("Arial", "", 12);

$sql = "SELECT r.Id_Reserva, u.nombre, r.fecha, r.hora, r.n_personas, 
               m.numero_mesa, r.estado
        FROM reserva r
        JOIN usuario u ON r.Id_Usuario = u.Id_Usuario
        JOIN mesa m ON r.Id_mesa = m.Id_mesa
        ORDER BY r.Id_Reserva";

$resultado = $conn->query($sql);

while ($fila = $resultado->fetch_assoc()) {
    $pdf->Cell(20, 10, $fila["Id_Reserva"], 1);
    $pdf->Cell(40, 10, $fila["nombre"], 1);
    $pdf->Cell(30, 10, $fila["fecha"], 1);
    $pdf->Cell(25, 10, $fila["hora"], 1);
    $pdf->Cell(25, 10, $fila["n_personas"], 1);
    $pdf->Cell(25, 10, $fila["numero_mesa"], 1);
    $pdf->Cell(25, 10, $fila["estado"], 1);
    $pdf->Ln();
}

$pdf->Output();
?>
