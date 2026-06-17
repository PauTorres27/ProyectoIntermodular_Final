<?php
require_once "conexion.php";

$nombre = $_POST['nombre'];
$tipo = $_POST['tipo'];

$sql = "INSERT INTO menu (nombre, tipo) VALUES (?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $nombre, $tipo);
$stmt->execute();

header("Location: menu_listar.php");
exit();
?>