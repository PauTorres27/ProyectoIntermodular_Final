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
        INNER JOIN usuario u ON r.Id_Usuario = u.Id_Usuario
        ORDER BY r.fecha ASC, r.hora ASC";

$resultado = $conn->query($sql);

$reservas_futuras = [];
$reservas_pasadas = [];

$hoy = date("Y-m-d");

while ($fila = $resultado->fetch_assoc()) {

    // Canceladas SIEMPRE van al historial
    if ($fila['estado'] === "cancelada") {
        $reservas_pasadas[] = $fila;
        continue;
    }

    // Futuras solo si no están canceladas
    if ($fila['fecha'] >= $hoy) {
        $reservas_futuras[] = $fila;
    } else {
        $reservas_pasadas[] = $fila;
    }
}

function badgeEstado($estado, $fecha) {
    $hoy = date("Y-m-d");

    if ($fecha < $hoy && $estado !== "cancelada") {
        return '<span class="badge bg-secondary">Finalizada</span>';
    }

    switch ($estado) {
        case "pendiente": return '<span class="badge bg-warning text-dark">Pendiente</span>';
        case "confirmada": return '<span class="badge bg-success">Confirmada</span>';
        case "cancelada": return '<span class="badge bg-danger">Cancelada</span>';
        default: return '<span class="badge bg-secondary">Finalizada</span>';
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Gestión de Reservas</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>

<body class="bg-light">

<div class="container mt-4">

    <h2 class="mb-4">Gestión de Reservas</h2>

    <a href="admin.php" class="btn btn-secondary mb-3">Volver</a>

    <!-- FUTURAS -->
    <h4 class="text-primary">Reservas Futuras</h4>
    <table class="table table-bordered table-striped mb-5">
        <tr>
            <th>ID</th>
            <th>Cliente</th>
            <th>Mesa</th>
            <th>Fecha</th>
            <th>Hora</th>
            <th>Personas</th>
            <th>Estado</th>
            <th>Acciones</th>
        </tr>

        <?php if (empty($reservas_futuras)): ?>
            <tr><td colspan="8" class="text-center text-muted">No hay reservas futuras</td></tr>
        <?php else: ?>
            <?php foreach ($reservas_futuras as $r): ?>
            <tr>
                <td><?= $r['Id_Reserva'] ?></td>
                <td><?= $r['nombre_usuario'] ?></td>
                <td><?= $r['Id_mesa'] ?></td>
                <td><?= $r['fecha'] ?></td>
                <td><?= $r['hora'] ?></td>
                <td><?= $r['n_personas'] ?></td>
                <td><?= badgeEstado($r['estado'], $r['fecha']) ?></td>

                <td>
                    <!-- Solo editar/cancelar si NO está cancelada -->
                    <?php if ($r['estado'] !== "cancelada"): ?>

                        <a href="reserva_editar.php?id=<?= $r['Id_Reserva'] ?>" 
                           class="btn btn-warning btn-sm">Editar</a>

                        <a href="reserva_eliminar.php?id=<?= $r['Id_Reserva'] ?>" 
                           class="btn btn-danger btn-sm"
                           onclick="return confirm('¿Cancelar esta reserva?');">
                           Cancelar
                        </a>

                    <?php else: ?>
                        <span class="text-muted">Sin acciones</span>
                    <?php endif; ?>
                </td>

            </tr>
            <?php endforeach; ?>
        <?php endif; ?>
    </table>

    <!-- HISTORIAL -->
    <h4 class="text-secondary">Historial de Reservas</h4>
    <table class="table table-bordered" style="background-color:#f8f9fa;">
        <tr class="table-light">
            <th>ID</th>
            <th>Cliente</th>
            <th>Mesa</th>
            <th>Fecha</th>
            <th>Hora</th>
            <th>Personas</th>
            <th>Estado</th>
        </tr>

        <?php if (empty($reservas_pasadas)): ?>
            <tr><td colspan="7" class="text-center text-muted">No hay historial</td></tr>
        <?php else: ?>
            <?php foreach ($reservas_pasadas as $r): ?>
            <tr class="text-muted">
                <td><?= $r['Id_Reserva'] ?></td>
                <td><?= $r['nombre_usuario'] ?></td>
                <td><?= $r['Id_mesa'] ?></td>
                <td><?= $r['fecha'] ?></td>
                <td><?= $r['hora'] ?></td>
                <td><?= $r['n_personas'] ?></td>
                <td><?= badgeEstado($r['estado'], $r['fecha']) ?></td>
            </tr>
            <?php endforeach; ?>
        <?php endif; ?>
    </table>

</div>

</body>
</html>
