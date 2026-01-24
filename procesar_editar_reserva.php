<?php
require_once "conexion.php";

$id = $_POST['id'];
$usuario = $_POST['Id_Usuario'];
$mesa = $_POST['Id_mesa'];
$fecha = $_POST['fecha'];
$hora = $_POST['hora'];
$personas = $_POST['n_personas'];
$estado = $_POST['estado'];

$sql = "UPDATE reserva
        SET Id_Usuario = ?,
            Id_mesa = ?,
            fecha = ?,
            hora = ?,
            n_personas = ?,
            estado = ?
        WHERE Id_Reserva = ?";


$stmt = $conexion->prepare($sql);

if (!$stmt) {
     die("Error en prepare(): " . $conexion->error); 
}

$stmt->bind_param("iissisi", $usuario, $mesa, $fecha, $hora, $personas, $estado, $id);
$stmt->execute();

header("Location: reserva_listar.php");
exit();
?>