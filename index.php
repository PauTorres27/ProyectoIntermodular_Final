<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Luckiest+Guy&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="styles.css">
    <title>Login</title>
</head>
<body class="login-bg">
    <div class="login-container">
        <h2>Bienvenido</h2>
        <form action="procesar_login.php" method="POST">
            <label for="usuario">Usuario</label>
            <input type="text" id="usuario" name="email" required>

            <label for="password">Contraseña</label>
            <input type="password" id="password" name="password" required>

            <button type="submit">Entrar</button>
        </form>
    </div>

    <script src="validaciones.js"></script>
</body>
</html>