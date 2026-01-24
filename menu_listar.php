<?php
session_start();
require_once "conexion.php";


//Admin
if (!isset($_SESSION['Id_Usuario']) || $_SESSION['rol'] !== "admin") {
    header("Location: login.html");
    exit();
}

$sql = "SELECT * FROM Menu";
$resultado = $conexion->query($sql);
?>


<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Menús</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>

<body class="bg-light">

<div class="container mt-4">
    <h2 class="mb-4">Gestión de Menús</h2>

    <a href="menu_crear.php" class="btn btn-success mb-3">Crear Menú</a>
    <a href="admin.php" class="btn btn-secondary mb-3">Volver</a>

    <table class="table table-striped table-bordered">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Tipo</th>
                <th>Acciones</th>
            </tr>
        </thead>

    <tbody>
        <?php while ($fila = $resultado->fetch_assoc()) { ?>
        <tr>
                <td><?php echo $fila['Id_menu']; ?></td>
                <td><?php echo $fila['nombre']; ?></td>
                <td><?php echo $fila['tipo']; ?></td>
                <td>
                    <a href="menu_editar.php?id=<?php echo $fila['Id_menu']; ?>" class="btn btn-warning btn-sm">Editar</a>
                    <a href="menu_eliminar.php?id=<?php echo $fila['Id_menu']; ?>" class="btn btn-danger btn-sm"
                     onclick="return confirm('Seguro que deseas eliminar esta menú?')">Eliminar</a>
                </td>
            </tr>
        <?php } ?>
    </tbody>
  </table>
</div>

</body>
</html>