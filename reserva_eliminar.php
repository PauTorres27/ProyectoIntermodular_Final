<?php
require_once "conexion.php";

$id = $_GET['id'];

$sql = "UPDATE reserva SET estado = 'cancelada' WHERE Id_Reserva = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();

header("Location: admin_reservas.php");
exit();
?>
