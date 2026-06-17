<?php
include 'conexion.php';

// BÚSQUEDA
$busqueda = isset($_GET['busqueda']) ? $_GET['busqueda'] : "";

// CONSULTA
$sql = "SELECT * FROM mesa 
        WHERE activo = 1 AND ubicacion LIKE ?
        ORDER BY Id_mesa ASC";

$stmt = $conn->prepare($sql);
$like = "%$busqueda%";
$stmt->bind_param("s", $like);
$stmt->execute();
$resultado = $stmt->get_result();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Listado de Mesas</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="reservas-bg">

<div class="container mt-5 p-4 bg-light rounded shadow">
    

    <h2 class="mb-4">Gestión de Mesas</h2>

    <form method="GET" class="d-flex mb-3">
        <input type="text" name="busqueda" class="form-control me-2" placeholder="Buscar por ubicación" value="<?= $busqueda ?>">
        <button class="btn btn-primary">Buscar</button>
    </form>

    <a href="nueva_mesa.php" class="btn btn-success mb-3">Añadir Mesa</a>

    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Ubicación</th>
                <th>Capacidad</th>
                <th>Ocupación Min</th>
                <th>Ocupación Max</th>
                <th>Tipo</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($fila = $resultado->fetch_assoc()): ?>
            <tr>
                <td><?= $fila['Id_mesa'] ?></td>
                <td><?= $fila['ubicacion'] ?></td>
                <td><?= $fila['capacidad'] ?></td>
                <td><?= $fila['ocupacion_min'] ?></td>
                <td><?= $fila['ocupacion_max'] ?></td>
                <td><?= $fila['tipo'] ?></td>
                <td>
                    <a href="editar_mesa.php?id=<?= $fila['Id_mesa'] ?>" class="btn btn-warning btn-sm">Editar</a>
                    <a href="procesar_mesa.php?eliminar=<?= $fila['Id_mesa'] ?>" class="btn btn-danger btn-sm"
                       onclick="return confirm('¿Seguro que deseas eliminar esta mesa?');">Eliminar</a>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>

    <a href="admin.php" class="btn btn-dark mt-3">Volver al Panel de Administración</a>

</div>

</body>
</html>
