<?php
session_start();
require_once "conexion.php";

if (!isset($_SESSION['Id_Usuario']) || $_SESSION['rol'] !== "admin") {
    header("Location: index.php");
    exit();
}

$sql = "SELECT 
            r.Id_Reserva,
            u.nombre AS nombre_usuario,
            r.Id_mesa,
            r.fecha,
            r.hora,
            r.n_personas,
            r.estado
        FROM reserva r
        INNER JOIN usuario u ON r.Id_Usuario = u.Id_Usuario";

$resultado = $conexion->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Reservas Administrador</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>

<body class="bg-light">

<div class="container mt-4">
    <h2 class="mb-4">Todas las Reservas</h2>

    <table class="table table-bordered table-striped">
        <tr>
            <th>ID Reserva</th>
            <th>Cliente</th>
            <th>ID Mesa</th>
            <th>Fecha</th>
            <th>Hora</th>
            <th>Personas</th>
            <th>Estado</th>
        </tr>

        <?php while ($fila = $resultado->fetch_assoc()) { ?>
        <tr>
            <td><?= $fila['Id_Reserva'] ?></td>
            <td><?= $fila['nombre_usuario'] ?></td>
            <td><?= $fila['Id_mesa'] ?></td>
            <td><?= $fila['fecha'] ?></td>
            <td><?= $fila['hora'] ?></td>
            <td><?= $fila['n_personas'] ?></td>
            <td><?= $fila['estado'] ?></td>
        </tr>
        <?php } ?>
    </table>

    <a href="admin.php" class="btn btn-secondary">Volver</a>
</div>

</body>
</html>
