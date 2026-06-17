<?php
session_start();
require_once "conexion.php";

if (!isset($_SESSION['Id_Usuario'])) {
    echo "<script>
            alert('Debes iniciar sesión para reservar');
            window.location.href='index.php';
          </script>";
    exit();
}

$id_usuario = $_SESSION['Id_Usuario'];


$fecha = $_POST['fecha'] ?? null;
$hora = $_POST['hora'] ?? null;
$personas = $_POST['personas'] ?? null;
$mesa = $_POST['mesa'] ?? null;


if (!$mesa || !$fecha || !$hora || !$personas) {
    echo "<script>
            alert('Faltan datos obligatorios');
            window.history.back();
          </script>";
    exit();
}

$sql = "INSERT INTO reserva (Id_Usuario, Id_mesa, fecha, hora, n_personas, estado)
        VALUES (?, ?, ?, ?, ?, 'pendiente')";

$stmt = $conn->prepare($sql);

if (!$stmt) {
    die("ERROR PREPARE: " . $conn->error);
}

if (!$stmt->bind_param("iissi", $id_usuario, $mesa, $fecha, $hora, $personas)) {
    die("ERROR BIND: " . $stmt->error);
}

if (!$stmt->execute()) {
    die("ERROR EXECUTE: " . $stmt->error);
}

echo "<script>
            alert('Reserva realizada con éxito');
            window.location.href='mis_reservas.php';
          </script>";
    exit();

?>
