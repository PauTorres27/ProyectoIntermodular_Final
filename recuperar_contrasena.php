<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Recuperar Contraseña</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>

<body class="bg-light">

<div class="container mt-5" style="max-width: 450px;">
    <h3 class="text-center mb-4">Recuperar Contraseña</h3>

    <form action="procesar_recuperar.php" method="POST">

        <label class="form-label">Introduce tu email</label>
        <input type="email" name="email" class="form-control" required>

        <button class="btn btn-primary w-100 mt-4">Continuar</button>

        <div class="text-center mt-3">
            <a href="index.php">Volver al inicio</a>
        </div>

    </form>
</div>

</body>
</html>
