<?php
session_start();

// Si no hay usuario logueado, lo echa fuera
if (!isset($_SESSION['Id_Usuario'])) {
    header("Location: index.php?error=Debes iniciar sesión");
    exit();
}

$idUsuario = $_SESSION['Id_Usuario'];

// Conexión a base de datos
require_once 'conexion.php';

// datos del usuario
$sql = "SELECT nombre, email, telefono FROM usuario WHERE Id_Usuario = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $idUsuario);
$stmt->execute();
$result = $stmt->get_result();
$usuario = $result->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Gestionar perfil</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body class="login-bg">

    <div class="login-container">
        <h2>Gestionar perfil</h2>

        <!-- Mensajes -->
        <?php if (isset($_GET['msg'])): ?>
            <div class="success-box">
                <?= htmlspecialchars($_GET['msg']) ?>
            </div>
        <?php endif; ?>

        <?php if (isset($_GET['error'])): ?>
            <div class="error-box">
                <?= htmlspecialchars($_GET['error']) ?>
            </div>
        <?php endif; ?>

        <!-- Datos personales -->
        <h3>Datos personales</h3>
        <form action="procesar_perfil.php" method="POST">
            <input type="hidden" name="accion" value="actualizar_datos">

            <label>Nombre</label>
            <input type="text" name="nombre" value="<?= htmlspecialchars($usuario['nombre']) ?>" required>

            <label>Teléfono</label>
            <input type="text" name="telefono" value="<?= htmlspecialchars($usuario['telefono'] ?? '') ?>">

            <label>Email</label>
            <input type="email" name="email" value="<?= htmlspecialchars($usuario['email']) ?>" required>

            <button type="submit" class="btn btn-primary w-100 mb-4">Guardar cambios</button>
        </form>

        <!-- Cambiar contraseña -->
        <h3>Cambiar contraseña</h3>
        <form action="procesar_perfil.php" method="POST">
            <input type="hidden" name="accion" value="cambiar_password">

            <label>Contraseña actual</label>
            <input type="password" name="password_actual" required>

            <label>Nueva contraseña</label>
            <input type="password" name="password_nueva" required>

            <label>Repetir nueva contraseña</label>
            <input type="password" name="password_repetida" required>

            <button type="submit" class="btn btn-secondary w-100 mb-4">Cambiar contraseña</button>
        </form>

        <!-- Desactivar cuenta -->
        <h3>Dar de baja mi cuenta</h3>
        <form action="procesar_perfil.php" method="POST" onsubmit="return confirm('¿Seguro que quieres desactivar tu cuenta?');">
            <input type="hidden" name="accion" value="desactivar_cuenta">
            <button type="submit" class="btn btn-danger w-100">Desactivar mi cuenta</button>
        </form>


        <!-- Botón volver al panel -->
        <a href="usuario.php" class="btn btn-outline-light w-100 mt-3 enlace-login">
            Volver al panel
        </a>

    </div>

     <!-- Script para mostrar/ocultar la contraseña -->
    <script>
    document.querySelectorAll('.toggle-pass').forEach(icon => {
        icon.addEventListener('click', () => {
            const input = document.getElementById(icon.dataset.target);
            const isPassword = input.type === "password";
            input.type = isPassword ? "text" : "password";
            icon.classList.toggle("bi-eye-fill");
            icon.classList.toggle("bi-eye-slash-fill");
        });
    });
    </script>

</body>
</html>
