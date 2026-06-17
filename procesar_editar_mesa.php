<?php
require_once "conexion.php";

$id = $_POST['id'];
$ubicacion = $_POST['ubicacion'];
$capacidad = $_POST['capacidad'];


$sql = "UPDATE mesa SET ubicacion = ?, capacidad = ? WHERE Id_mesa = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("sii", $ubicacion, $capacidad, $id);
$stmt->execute();

header("Location: mesa_listar.php");
exit();
?>