<?php
session_start();
require_once "conexion.php";


//Admin
if (!isset($_SESSION['Id_Usuario']) || $_SESSION['rol'] !== "admin") {
    header("Location: index.php");
    exit();
}

$sql = "SELECT r.Id_Reserva, r.fecha, r.hora, r.n_personas, r.estado,
               u.nombre AS usuario,
               m.numero_mesa AS mesa
        FROM reserva r
        JOIN usuario u ON r.Id_Usuario = u.Id_Usuario
        JOIN mesa m ON r.Id_mesa = m.Id_mesa
        ORDER BY r.Id_Reserva";

$resultado = $conn->query($sql);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Reservas</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>

<body class="bg-light">

<div class="container mt-4">
    <h2 class="mb-4">Gestión de Reservas</h2>

    <a href="reserva_crear.php" class="btn btn-success mb-3">Crear Reserva</a>
    <a href="admin.php" class="btn btn-secondary mb-3">Volver</a>

    <table class="table table-striped table-bordered">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Usuario</th>
                <th>Mesa</th>
                <th>Fecha</th>
                <th>Hora</th>
                <th>Personas</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>

    <tbody>
        <?php while ($fila = $resultado->fetch_assoc()) { ?>
        <tr>
                <td><?php echo $fila['Id_Reserva']; ?></td>
                <td><?php echo $fila['usuario']; ?></td>
                <td><?php echo $fila['mesa']; ?></td>
                <td><?php echo $fila['fecha']; ?></td>
                <td><?php echo $fila['hora']; ?></td>
                <td><?php echo $fila['n_personas']; ?></td>
                <td><?php echo $fila['estado']; ?></td>
                <td>
                    <a href="reserva_editar.php?id=<?php echo $fila['Id_Reserva']; ?>" class="btn btn-warning btn-sm">Editar</a>
                    <a href="reserva_eliminar.php?id=<?php echo $fila['Id_Reserva']; ?>" class="btn btn-danger btn-sm"
                     onclick="return confirm('Seguro que deseas eliminar esta reserva?')">Eliminar</a>
                    <a href="exportar_reservas_pdf.php" class="btn btn-danger">Exportar PDF</a>
                </td>
            </tr>
        <?php } ?>
    </tbody>
  </table>
</div>

</body>
</html>