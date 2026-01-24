<?php
session_start();
require_once "conexion.php";

//Solo Admin
if (!isset($_SESSION['Id_Usuario']) || $_SESSION['rol'] !== "admin") {
    header("Location: index.php");
    exit();
}

//Comprobar si llega el ID
if (!isset($_GET['id'])) {
    header("Location: admin_usuarios.php");
    exit();
}

$id = $_GET['id'];


//Elimina Usuario
$sql = "DELETE FROM usuario WHERE Id_Usuario = ?";
$stmt = $conexion->prepare($sql);

if (!$stmt) {
     die("Error en prepare(): " . $conexion->error); 
}

$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    header("Location: admin_usuarios.php");
    exit();
} else {
    echo "Error al eliminar el usuario";
}
?>