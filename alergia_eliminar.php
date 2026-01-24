<?php
require_once "conexion.php";

$id = $_GET['id'];


$sql = "DELETE FROM alergia WHERE Id_alergia = ?";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();

header("Location: alergia_listar.php");
exit();
?>