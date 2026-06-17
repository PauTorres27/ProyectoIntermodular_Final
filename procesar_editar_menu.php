<?php
require_once "conexion.php";

$id = $_POST['id'];
$nombre = $_POST['nombre'];
$tipo = $_POST['tipo'];


$sql = "UPDATE menu SET nombre = ?, tipo = ? WHERE Id_menu = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssi", $nombre, $tipo, $id);
$stmt->execute();

header("Location: menu_listar.php");
exit();
?>