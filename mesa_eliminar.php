<?php
require_once "conexion.php";

$id = $_GET['id'];


$sql = "DELETE FROM mesa WHERE Id_mesa = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();

header("Location: mesa_listar.php");
exit();
?>