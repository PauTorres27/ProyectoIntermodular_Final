<?php
session_start();

if (!isset($_SESSION['Id_Usuario']) || $_SESSION['rol'] !== "admin") {
    header("Location: index.php");
    exit();
}

$nombre = $_SESSION['nombre'];
?>



<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Panel de Administrador</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>

<body class="bg-light">

<!-- NAVBAR -->
<nav class="navbar navbar-dark bg-dark">
    <div class="container-fluid">
        <span class="navbar-brand">Panel de Administración</span>
        <span class="navbar-text text-white">Administrador: <?php echo $nombre; ?></span>
        <a href="logout.php" class="btn btn-outline-light">Cerrar sesión</a>
    </div>
</nav>

<div class="container mt-4">
    <div class="row g-4">

    <!-- Gestión de Usuarios -->
     <div class="col-md-4">
        <div class="card shadow">
            <div class="card-body text-center">
                <h5 class="card-title">Usuarios</h5>
                <p class="card-text">Gestiona los usuarios registrados</p>
                <a href="admin_usuarios.php" class="btn btn-primary">Administrar usuarios</a>
            </div>
        </div>
    </div>


    <!-- Gestió de Reservas -->
      <div class="col-md-4">
        <div class="card shadow">
            <div class="card-body text-center">
                <h5 class="card-title">Reservas</h5>
                <p class="card-text">Consulta, o elimina reservas</p>
                <a href="admin_reservas.php" class="btn btn-success">Gestionar reservas</a>

            </div>
        </div>
    </div>


    <!-- Estadisticas -->
      <div class="col-md-4">
        <div class="card shadow">
            <div class="card-body text-center">
                <h5 class="card-title">Estadisticas</h5>
                <p class="card-text">Verificar datos del restaurante</p>
                <a href="#" class="btn btn-warning">Ver estadísticas</a>
            </div>
        </div>
    </div>

    </div>
</div>


</body>
</html>