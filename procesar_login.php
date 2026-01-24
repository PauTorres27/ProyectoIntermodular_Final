<?php
include 'conexion.php';

$email = $_POST['email'];
$password = $_POST['password'];

$sql = "SELECT * FROM usuario WHERE email = ?";
$stmt = $conexion->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$resultado = $stmt->get_result();

if ($resultado->num_rows > 0) {
    $fila = $resultado->fetch_assoc();

    if (trim($password) === trim($fila['contrasena'])) {
        session_start();
        $_SESSION['Id_Usuario'] = $fila['Id_Usuario'];
        $_SESSION['rol'] = $fila['rol'];
        $_SESSION['nombre'] = $fila['nombre'];

        if ($fila['rol'] == 'admin') {
            header("Location: admin.php");
        } else {
            header("Location: usuario.php");
        }
        exit();
    } else {
        echo "Contraseña incorrecta";
    }
} else {
    echo "Usuario no encontrado";
}
?>
