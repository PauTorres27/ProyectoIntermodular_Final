<?php
require_once "conexion.php";

$usuario = $_POST['Id_Usuario'];
$mesa = $_POST['Id_mesa'];
$fecha = $_POST['fecha'];
$hora = $_POST['hora'];
$personas = $_POST['n_personas'];
$estado = $_POST['estado'];


$sql = "INSERT INTO reserva (Id_Usuario, Id_mesa, fecha, hora, n_personas, estado)
 VALUES (?, ?, ?, ?, ?, ?)";

$stmt = $conn->prepare($sql);
$stmt->bind_param("iissis", $usuario, $mesa, $fecha, $hora, $personas, $estado);
$stmt->execute();

header("Location: admin_reservas.php");
exit();
?>