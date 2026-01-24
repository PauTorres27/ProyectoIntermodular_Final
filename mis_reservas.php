<?php
session_start();
require_once "conexion.php";

// Si no hay sesión, fuera
if (!isset($_SESSION['Id_Usuario'])) {
    header("Location: index.php");
    exit();
}

$id = $_SESSION['Id_Usuario'];

// Obtener SOLO las reservas del usuario logueado
$sql = "SELECT Id_Reserva, Id_mesa, fecha, hora, n_personas, estado 
        FROM reserva 
        WHERE Id_Usuario = ?";

$stmt = $conexion->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$resultado = $stmt->get_result();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Mis Reservas</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>

<body class="bg-light">

<div class="container mt-4">
    <h2 class="mb-4">Mis Reservas</h2>

    <table class="table table-bordered table-striped">
        <tr>
            <th>ID Reserva</th>
            <th>ID Mesa</th>
            <th>Fecha</th>
            <th>Hora</th>
            <th>Personas</th>
            <th>Estado</th>
        </tr>

        <?php while ($fila = $resultado->fetch_assoc()) { ?>
        <tr>
            <td><?= $fila['Id_Reserva'] ?></td>
            <td><?= $fila['Id_mesa'] ?></td>
            <td><?= $fila['fecha'] ?></td>
            <td><?= $fila['hora'] ?></td>
            <td><?= $fila['n_personas'] ?></td>
            <td><?= $fila['estado'] ?></td>
        </tr>
        <?php } ?>
    </table>

    <a href="usuario.php" class="btn btn-secondary">Volver</a>
</div>

</body>
</html>
