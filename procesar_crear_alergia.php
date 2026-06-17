<?php
require_once "conexion.php";

$nombre = $_POST['nombre_alergia'];

$sql = "INSERT INTO alergia (nombre_alergia) VALUES (?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $nombre);
$stmt->execute();

header("Location: alergia_listar.php");
exit();
?>