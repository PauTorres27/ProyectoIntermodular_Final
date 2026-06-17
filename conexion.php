<?php
$host = "sql210.infinityfree.com";
$usuario = "if0_40974340";
$contrasena = "2AQ0CsYdWFnDQOI";
$base_datos = "if0_40974340_restaurante";

$conn = new mysqli($host, $usuario, $contrasena, $base_datos);

if ($conn->connect_error) {
    die("Error de conexión: " . $conn->connect_error);
}

?>
