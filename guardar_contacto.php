<?php
require_once "conexion.php";

$nombre = $_POST['nombre'] ?? null;
$email = $_POST['email'] ?? null;
$mensaje = $_POST['mensaje'] ?? null;

if (!$nombre || !$email || !$mensaje) {
    echo "<script>alert('Faltan datos obligatorios'); window.location.href='contacto.html';</script>";
    exit;
}

$sql = "INSERT INTO contacto (nombre, email, mensaje) VALUES (?, ?, ?)";
$stmt = $conexion->prepare($sql);

if ($stmt) {
    $stmt->bind_param("sss", $nombre, $email, $mensaje);
    if ($stmt->execute()) {
        echo "<script>alert('Mensaje enviado correctamente'); window.location.href='contacto.html';</script>";
    } else {
        echo "<script>alert('Error al guardar el mensaje'); window.location.href='contacto.html';</script>";
    }
} else {
    echo "<script>alert('Error en la base de datos'); window.location.href='contacto.html';</script>";
}
?>
