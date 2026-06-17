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
    <title>Zona de Usuario</title>
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
                    <a class="nav-link" href="mis_reservas.php">Mis reservas</a>
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
                    <a href="gestionar_perfil.php" class="btn btn-warning">Gestionar perfil</a>
                </div>
            </div>
        </div>

        <!-- Quiénes somos -->
<div class="col-md-4">
    <div class="card shadow">
        <div class="card-body text-center">
            <h5 class="card-title">Quiénes somos</h5>
            <p class="card-text">Conoce nuestra historia y nuestros espacios</p>
            <a href="quienes_somos.php" class="btn btn-info">Ver más</a>
        </div>
    </div>
</div>


    </div>
</div>


</body>
</html>
