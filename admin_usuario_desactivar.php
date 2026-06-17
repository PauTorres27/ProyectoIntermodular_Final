<?php
session_start();
require_once "conexion.php";

// Solo admin
if (!isset($_SESSION['Id_Usuario']) || $_SESSION['rol'] !== "admin") {
    header("Location: index.php");
    exit();
}

if (!isset($_GET['id'])) {
    header("Location: admin_usuarios.php");
    exit();
}

$id = $_GET['id'];

$sql = "UPDATE usuario SET activo = 0 WHERE Id_Usuario = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();

header("Location: admin_usuarios.php?msg=Usuario desactivado");
exit();
?>
