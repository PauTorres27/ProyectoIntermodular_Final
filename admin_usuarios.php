<?php
session_start();
require_once "conexion.php";

//Admin
if (!isset($_SESSION['Id_Usuario']) || $_SESSION['rol'] !== "admin") {
    header("Location: index.php");
    exit();
}

//Obtener usuarios
$sql = "SELECT * FROM usuario";
$resultado = $conexion->query($sql);

if (!$resultado) {
     die("Error en consulta usuarios: " . $conexion->error); 
}

?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> Gestión de Usuarios</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>

<body class="bg-light">

<div class="container mt-4">
    <h2 class="mb-4">Gestión de Usuarios</h2>

    <a href="admin_usuario_crear.php" class="btn btn-outline-primary mb-3">Añadir Usuario</a>

    <table class="table table-striped table-bordered">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Email</th>
                <th>Rol</th>
                <th>Teléfono</th>
                <th>Acciones</th>
            </tr>
        </thead>

        <tbody>
            <?php while ($fila = $resultado->fetch_assoc()) { ?>
            <tr>
                <td><?php echo $fila['Id_Usuario']; ?></td>
                <td><?php echo $fila['nombre']; ?></td>
                <td><?php echo $fila['email']; ?></td>
                <td><?php echo $fila['rol']; ?></td>
                <td><?php echo $fila['telefono']; ?></td>
                <td>
                    <a href="admin_usuario_editar.php?id=<?php echo $fila['Id_Usuario']; ?>" class="btn btn-warning btn-sm">Editar</a>
                    <a href="admin_usuario_eliminar.php?id=<?php echo $fila['Id_Usuario']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Seguro que deseas eliminar este usuario?')">Eliminar</a>
                </td>
            </tr>
        <?php } ?>
    </tbody>
</table>

<a href="admin.php" class="btn btn-secondary">Volver al Panel</a>
</div>


</body>
</html>

