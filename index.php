<?php
session_start();
if (isset($_GET['error']) && $_SERVER['REQUEST_METHOD'] === 'POST') {
    header("Location: index.php");
    exit();
}
?>


<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Luckiest+Guy&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
    <link rel="stylesheet" href="styles.css">
    <title>Login</title>
</head>
<body class="login-bg">
    <div class="login-container">
        <h2>Bienvenido</h2>

        <!-- BLOQUE DE ERROR -->
         <?php if (isset($_GET['error'])): ?>
            <div class="error-box">
                <?= htmlspecialchars($_GET['error']) ?>
            </div>
        <?php endif; ?>


        <form action="procesar_login.php" method="POST">
            <label for="usuario">Usuario</label>
            <input type="text" id="usuario" name="email" required>

            <label for="password">Contraseña</label>
            <input type="password" id="password" name="password" required>

            <button type="submit" class="btn btn-primary w-100 mb-4">Entrar</button>
        </form>

        <div class="mt-3 text-center mb-3">
             <a href="recuperar_contrasena.php" class="enlace-login">
             ¿Has olvidado tu contraseña?
            </a>
       </div>

       <div class="text-center mt-2">
            <a href="registro.php" class="enlace-login">
            ¿Aún no tienes cuenta? Regístrate
            </a>
       </div>



    <script src="validaciones.js"></script>
</body>
</html>