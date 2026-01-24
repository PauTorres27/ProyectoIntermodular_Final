<?php
session_start();
require_once "conexion.php";

if (!isset($_SESSION['Id_Usuario'])) {
    die("No hay sesión de usuario");
}

$id_usuario = $_SESSION['Id_Usuario'];

echo "<pre>";
echo "DEBUG: Datos recibidos:\n";
print_r($_POST);
echo "</pre>";

$nombre = $_POST['nombre'] ?? null;
$fecha = $_POST['fecha'] ?? null;
$hora = $_POST['hora'] ?? null;
$personas = $_POST['personas'] ?? null;
$email = $_POST['email'] ?? null;
$telefono = $_POST['telefono'] ?? null;
$mesa = $_POST['mesa'] ?? null;
$notas = $_POST['notas'] ?? null;

if (!$mesa || !$fecha || !$hora || !$personas) {
    die("ERROR: Falta algún dato obligatorio");
}

$sql = "INSERT INTO reserva (Id_Usuario, Id_mesa, fecha, hora, n_personas, estado)
        VALUES (?, ?, ?, ?, ?, 'pendiente')";

$stmt = $conexion->prepare($sql);

if (!$stmt) {
    die("ERROR PREPARE: " . $conexion->error);
}

if (!$stmt->bind_param("iissi", $id_usuario, $mesa, $fecha, $hora, $personas)) {
    die("ERROR BIND: " . $stmt->error);
}

if (!$stmt->execute()) {
    die("ERROR EXECUTE: " . $stmt->error);
}

echo "Reserva creada correctamente";
?>
