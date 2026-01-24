<?php
require_once "conexion.php";

$id = $_GET['id'];


$sql = "DELETE FROM reserva WHERE Id_Reserva = ?";
$stmt = $conexion->prepare($sql);

if (!$stmt) {
    die("Error en prepare(): " . $conexion->error);
}

$stmt->bind_param("i", $id);
$stmt->execute();

header("Location: reserva_listar.php");
exit();
?>