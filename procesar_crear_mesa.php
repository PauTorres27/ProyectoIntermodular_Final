<?php
require_once "conexion.php";

$ubicacion = $_POST['ubicacion'];
$capacidad = $_POST['capacidad'];

$sql = "INSERT INTO mesa (ubicacion, capacidad) VALUES (?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("si", $ubicacion, $capacidad);
$stmt->execute();

header("Location: mesa_listar.php");
exit();
?>