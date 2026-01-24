<?php
require_once "conexion.php";

$id = $_GET['id'];


$sql = "DELETE FROM menu WHERE Id_menu = ?";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();

header("Location: menu_listar.php");
exit();
?>