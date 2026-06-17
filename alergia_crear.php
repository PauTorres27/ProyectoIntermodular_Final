<?php
session_start();
require_once "conexion.php";

//Admin
if (!isset($_SESSION['Id_Usuario']) || $_SESSION['rol'] !== "admin") {
    header("Location: index.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Crear Alergia</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>

<body class="bg-light">

<div class="container mt-4">
    <h2 class="mb-4">Crear Alergia</h2>

    <form action="procesar_crear_alergia.php" method="POST" class="mt-3">

       <label class="form-label">Nombre de la Alergia</label>
          <input type="text" name="nombre_alergia" class="form-control" required>

        <button class="btn btn-success mt-3">Guardar</button>
       <a href="alergia_listar.php" class="btn btn-secondary mt-3">Volver</a>
    </form>
</div>

<div id="toast-container" class="position-fixed bottom-0 end-0 p-3" style="z-index: 9999;"></div>
<script src="validaciones.js"></script>

</body>
</html>