<?php
session_start();

if (!isset($_SESSION['Id_Usuario'])) {
    header("Location: index.php");
    exit();
}

$nombre = $_SESSION['nombre'];
$rol = $_SESSION['rol'];
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> Zona de Usuario</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>

<body class="bg-light">

<!--NAVBAR -->
<nav class="navbar navbar-dark bg-dark">
    <div class="container-fluid">
        <span class="navbar-brand">Zona de Usuario</span>
        <span class="navbar-text text-white">Hola, <?php echo $nombre; ?></span>
        <a href="logout.php" class="btn btn-outline-light">Cerrar sesión</a>
    </div>
</nav>

<div class="container mt-4">
    <div class="row g-4">

    <!-- Mis reservas -->

    <div class="col-md-4">
        <div class="card shadow">
            <div class="card-body text-center">
                <h5 class="card-title">Mis reservas</h5>
                <p class="card-text">Consulta tus reservas</p>
                <a href="mis_reservas.php" class="btn btn-primary">Ver reservas</a>
            </div>
        </div>
    </div>

    <!-- Crear reserva -->

    <div class="col-md-4">
        <div class="card shadow">
            <div class="card-body text-center">
                <h5 class="card-title">Nueva reserva</h5>
                <p class="card-text">Haz una nueva reserva en el restaurante</p>
                <a href="FormularioReservas.html" class="btn btn-success">Crear reserva</a>
            </div>
        </div>
    </div>

    <!-- Perfil -->

    <div class="col-md-4">
        <div class="card shadow">
            <div class="card-body text-center">
                <h5 class="card-title">Mi perfil</h5>
                <p class="card-text">Edita tus datos o puedes dar de baja tu cuenta</p>
                <a href="#" class="btn btn-warning">Gestionar perfil</a>
            </div>
        </div>
    </div>
  </div>
</div>


</body>
</html>