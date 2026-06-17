<?php
require_once "conexion.php";

$id = $_POST['id'];
$pass1 = $_POST['pass1'];
$pass2 = $_POST['pass2'];

if ($pass1 !== $pass2) {
    echo "<script>alert('Las contraseñas no coinciden'); history.back();</script>";
    exit();
}

// Encriptar contraseña
$nuevaPass = password_hash($pass1, PASSWORD_DEFAULT);

$sql = "UPDATE usuario SET contrasena = ? WHERE Id_Usuario = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("si", $nuevaPass, $id);
$stmt->execute();

echo "<script>alert('Contraseña actualizada correctamente'); window.location='index.php';</script>";
exit();
?>
