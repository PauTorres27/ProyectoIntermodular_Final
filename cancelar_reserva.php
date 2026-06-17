<?php
session_start();
require_once "conexion.php";

if (!isset($_SESSION['Id_Usuario'])) {
    header("Location: index.php");
    exit();
}

if (!isset($_GET['id'])) {
    header("Location: mis_reservas.php");
    exit();
}

$idReserva = $_GET['id'];

// Marcar como cancelada
$sql = "UPDATE reserva SET estado = 'cancelada' WHERE Id_Reserva = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $idReserva);
$stmt->execute();

header("Location: mis_reservas.php?msg=Reserva cancelada");
exit();
?>
