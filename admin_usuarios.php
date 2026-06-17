<?php
session_start();
require_once "conexion.php";

// Admin
if (!isset($_SESSION['Id_Usuario']) || $_SESSION['rol'] !== "admin") {
    header("Location: index.php");
    exit();
}

// Obtener usuarios
$sql = "SELECT * FROM usuario";
$resultado = $conn->query($sql);

if (!$resultado) {
     die("Error en consulta usuarios: " . $conn->error); 
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Gestión de Usuarios</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>

<body class="bg-light">

<div class="container mt-4">
    <h2 class="mb-4">Gestión de Usuarios</h2>

    <!-- Mensaje de éxito -->
    <?php if (isset($_GET['msg'])): ?>
        <div class="alert alert-success">
            <?= htmlspecialchars($_GET['msg']) ?>
        </div>
    <?php endif; ?>

    <a href="admin_usuario_crear.php" class="btn btn-outline-primary mb-3">Añadir Usuario</a>

    <table class="table table-striped table-bordered">
        <thead class="table-dark">
            <tr>
                <th>ID</th>
                <th>Nombre</th>
                <th>Email</th>
                <th>Rol</th>
                <th>Teléfono</th>
                <th>Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>

        <tbody>
            <?php while ($fila = $resultado->fetch_assoc()) { ?>
            <tr>
                <td><?= $fila['Id_Usuario']; ?></td>
                <td><?= $fila['nombre']; ?></td>
                <td><?= $fila['email']; ?></td>
                <td><?= $fila['rol']; ?></td>
                <td><?= $fila['telefono']; ?></td>

                <!-- Mostrar estado -->
                <td>
                    <?php if ($fila['activo'] == 1): ?>
                        <span class="badge bg-success">Activo</span>
                    <?php else: ?>
                        <span class="badge bg-secondary">Desactivado</span>
                    <?php endif; ?>
                </td>

                <td>
                    <!-- Botón Editar -->
                    <a href="admin_usuario_editar.php?id=<?= $fila['Id_Usuario']; ?>" 
                       class="btn btn-warning btn-sm">Editar</a>

                    <!-- Botón Activar / Desactivar -->
                    <?php if ($fila['activo'] == 1): ?>
                        <a href="admin_usuario_desactivar.php?id=<?= $fila['Id_Usuario']; ?>" 
                           class="btn btn-danger btn-sm"
                           onclick="return confirm('¿Seguro que deseas desactivar este usuario?')">
                           Desactivar
                        </a>
                    <?php else: ?>
                        <a href="admin_usuario_activar.php?id=<?= $fila['Id_Usuario']; ?>" 
                           class="btn btn-success btn-sm">
                           Activar
                        </a>
                    <?php endif; ?>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>

    <a href="admin.php" class="btn btn-secondary">Volver al Panel</a>
</div>

</body>
</html>
