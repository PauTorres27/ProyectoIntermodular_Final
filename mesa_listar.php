<?php
session_start();
require_once "conexion.php";

//Admin
if (!isset($_SESSION['Id_Usuario']) || $_SESSION['rol'] !== "admin") {
    header("Location: index.php");
    exit();
}

$sql = "SELECT * FROM mesa";
$resultado = $conn->query($sql);
?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Mesas</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>

<body class="bg-light">

<div class="container mt-4">
    <h2 class="mb-4">Gestión de Mesas</h2>

    <a href="mesa_crear.php" class="btn btn-success mb-3">Crear Mesa</a>
    <a href="admin.php" class="btn btn-secondary mb-3">volver</a>

    <table class="table table-striped table-bordered">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Ubicación</th>
                <th>Capacidad</th>
                <th>Acciones</th>
            </tr>
    </thead>

    <tbody>
        <?php while ($fila = $resultado->fetch_assoc()) { ?>
            <tr>
                <td><?php echo $fila['Id_mesa']; ?></td>
                <td><?php echo $fila['ubicacion']; ?></td>
                <td><?php echo $fila['capacidad']; ?></td>
                <td>
                    <a href="mesa_editar.php?id=<?php echo $fila['Id_mesa']; ?>" class="btn btn-warning btn-sm">Editar</a>
                    <a href="mesa_eliminar.php?id=<?php echo $fila['Id_mesa']; ?>" class="btn btn-danger btn-sm"
                     onclick="return confirm('Seguro que deseas eliminar esta mesa?')">Eliminar</a>
                </td>
            </tr>
        <?php } ?>
    </tbody>
  </table>
</div>

</body>
</html>


