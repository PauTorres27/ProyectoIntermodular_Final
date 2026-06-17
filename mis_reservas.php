<?php
session_start();
require_once "conexion.php";

// Si no hay sesión, fuera
if (!isset($_SESSION['Id_Usuario'])) {
    header("Location: index.php");
    exit();
}

$id = $_SESSION['Id_Usuario'];
$nombre = $_SESSION['nombre'];

// Obtener reservas del usuario
$sql = "SELECT Id_Reserva, Id_mesa, fecha, hora, n_personas, estado 
        FROM reserva 
        WHERE Id_Usuario = ?
        ORDER BY fecha ASC, hora ASC";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$resultado = $stmt->get_result();

// Separar futuras y pasadas
$reservas_futuras = [];
$reservas_pasadas = [];

$hoy = date("Y-m-d");

while ($fila = $resultado->fetch_assoc()) {
    if ($fila['fecha'] >= $hoy) {
        $reservas_futuras[] = $fila;
    } else {
        $reservas_pasadas[] = $fila;
    }
}

// Función para mostrar badge (mejorada)
function badgeEstado($estado, $fecha) {
    $hoy = date("Y-m-d");

    // Si la fecha ya pasó y no está cancelada → finalizada
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
    <title>Mis Reservas</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>

<body class="bg-light">

<!-- NAVBAR -->
<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
    <div class="container-fluid">

        <a class="navbar-brand d-flex align-items-center" href="index.php">
            <img src="fondo-logo.jpg" alt="Logo" width="40" height="40" class="me-2">
            Restaurante Gourmet
        </a>

        <div class="mx-auto d-none d-lg-block" style="position:absolute; left:50%; transform:translateX(-50%);">
            <span class="navbar-text text-warning">
                Hola, <?php echo $nombre; ?>
            </span>
        </div>

        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ms-auto">

                <li class="nav-item">
                    <a class="nav-link" href="index.php">Inicio</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="FormularioReservas.html">Reservar</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link active" href="mis_reservas.php">Mis reservas</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="contacto.html">Contacto</a>
                </li>

                <li class="nav-item">
                    <a class="nav-link text-danger" href="logout.php">Cerrar sesión</a>
                </li>

            </ul>
        </div>
    </div>
</nav>
<!-- FIN NAVBAR -->

<div class="container mt-4">

    <h2 class="mb-4">Mis Reservas</h2>

    <!-- RESERVAS FUTURAS -->
    <h4 class="text-primary">Reservas futuras</h4>
    <div class="table-responsive mb-5">
        <table class="table table-bordered table-striped">
            <tr>
                <th>ID</th>
                <th>Mesa</th>
                <th>Fecha</th>
                <th>Hora</th>
                <th>Personas</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>

            <?php if (empty($reservas_futuras)): ?>
                <tr><td colspan="7" class="text-center text-muted">No tienes reservas futuras</td></tr>
            <?php else: ?>
                <?php foreach ($reservas_futuras as $r): ?>
                <tr>
                    <td><?= $r['Id_Reserva'] ?></td>
                    <td><?= $r['Id_mesa'] ?></td>
                    <td><?= $r['fecha'] ?></td>
                    <td><?= $r['hora'] ?></td>
                    <td><?= $r['n_personas'] ?></td>
                    <td><?= badgeEstado($r['estado'], $r['fecha']) ?></td>
                    <td>
                        <?php if ($r['estado'] !== "cancelada"): ?>
                            <a href="cancelar_reserva.php?id=<?= $r['Id_Reserva'] ?>" 
                               class="btn btn-danger btn-sm"
                               onclick="return confirm('¿Seguro que deseas cancelar esta reserva?');">
                               Cancelar
                            </a>
                        <?php endif; ?>
                    </td>
                </tr>
                <?php endforeach; ?>
            <?php endif; ?>
        </table>
    </div>

    <!-- HISTORIAL -->
    <h4 class="text-secondary">Historial de reservas</h4>
    <div class="table-responsive">
        <table class="table table-bordered" style="background-color:#f8f9fa;">
            <tr class="table-light">
                <th>ID</th>
                <th>Mesa</th>
                <th>Fecha</th>
                <th>Hora</th>
                <th>Personas</th>
                <th>Estado</th>
            </tr>

            <?php if (empty($reservas_pasadas)): ?>
                <tr><td colspan="6" class="text-center text-muted">No hay historial</td></tr>
            <?php else: ?>
                <?php foreach ($reservas_pasadas as $r): ?>
                <tr class="text-muted">
                    <td><?= $r['Id_Reserva'] ?></td>
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

    <a href="usuario.php" class="btn btn-secondary mt-3">Volver</a>

</div>

</body>
</html>
