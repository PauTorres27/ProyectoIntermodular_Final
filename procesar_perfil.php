<?php
session_start();
require_once 'conexion.php';

// Si no hay usuario logueado, lo echa fuera
if (!isset($_SESSION['Id_Usuario'])) {
    header("Location: index.php?error=Debes iniciar sesión");
    exit();
}

$idUsuario = $_SESSION['Id_Usuario'];

// Comprobamos la acción que viene del formulario
$accion = $_POST['accion'] ?? '';



// Actualizar datos personales

if ($accion === 'actualizar_datos') {

    $nombre = trim($_POST['nombre']);
    $telefono = trim($_POST['telefono']);
    $email = trim($_POST['email']);

    // Comprobar si el email ya existe en otro usuario
    $sql = "SELECT Id_Usuario FROM usuario WHERE email = ? AND Id_Usuario != ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $email, $idUsuario);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($resultado->num_rows > 0) {
        header("Location: gestionar_perfil.php?error=El correo ya está en uso");
        exit();
    }

    // Actualizar datos
    $sql = "UPDATE usuario SET nombre = ?, telefono = ?, email = ? WHERE Id_Usuario = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssi", $nombre, $telefono, $email, $idUsuario);

    if ($stmt->execute()) {
        header("Location: gestionar_perfil.php?msg=Datos actualizados correctamente");
        exit();
    } else {
        header("Location: gestionar_perfil.php?error=Error al actualizar los datos");
        exit();
    }
}



// Cambiar contraseña

if ($accion === 'cambiar_password') {

    $password_actual = $_POST['password_actual'];
    $password_nueva = $_POST['password_nueva'];
    $password_repetida = $_POST['password_repetida'];

    // Comprobar que coinciden
    if ($password_nueva !== $password_repetida) {
        header("Location: gestionar_perfil.php?error=Las contraseñas no coinciden");
        exit();
    }

    // Sacar la contraseña actual de la base de datos
    $sql = "SELECT contrasena FROM usuario WHERE Id_Usuario = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $idUsuario);
    $stmt->execute();
    $resultado = $stmt->get_result();
    $fila = $resultado->fetch_assoc();

    // Verificar contraseña actual
    if (!password_verify($password_actual, $fila['contrasena'])) {
        header("Location: gestionar_perfil.php?error=La contraseña actual es incorrecta");
        exit();
    }

    // Encriptar nueva contraseña
    $password_hash = password_hash($password_nueva, PASSWORD_DEFAULT);

    // Actualizar contraseña
    $sql = "UPDATE usuario SET contrasena = ? WHERE Id_Usuario = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("si", $password_hash, $idUsuario);

    if ($stmt->execute()) {
        header("Location: gestionar_perfil.php?msg=Contraseña cambiada correctamente");
        exit();
    } else {
        header("Location: gestionar_perfil.php?error=Error al cambiar la contraseña");
        exit();
    }
}



// Desactivar cuenta

if ($accion === 'desactivar_cuenta') {

    $sql = "UPDATE usuario SET activo = 0 WHERE Id_Usuario = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $idUsuario);

    if ($stmt->execute()) {
        header("Location: index.php?msg=Cuenta desactivada correctamente");
        session_destroy();
        exit();
    } else {
        header("Location: gestionar_perfil.php?error=No se pudo desactivar la cuenta");
        exit();
    }
}

?>
