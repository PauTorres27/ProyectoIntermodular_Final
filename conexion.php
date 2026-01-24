<?php
$host = "sql210.infinityfree.com";
$usuario = "if0_40974340";
$contrasena = "2AQ0CsYdWFnDQOI";
$base_datos = "if0_40974340_restaurante";

$conexion = new mysqli($host, $usuario, $contrasena, $base_datos);

if ($conexion->connect_error) {
    die("Error de conexión: " . $conexion->connect_error);
}
?>
