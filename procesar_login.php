<?php
include 'conexion.php';

$email = $_POST['email'];
$password = $_POST['password'];

$sql = "SELECT * FROM usuario WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$resultado = $stmt->get_result();

//Usuario no existe
if ($resultado->num_rows === 0) {
    header("Location: index.php?error=Usuario no encontrado");
    exit();
}

    $fila = $resultado->fetch_assoc();

    //Usuario desactivado
    if ($fila['activo'] == 0) {
        header("Location: index.php?error=Usuario desactivado");
    exit();
    }

    // Verificamos contraseña incorrecta y encriptada
    if (!password_verify($password, $fila['contrasena'])) {
        header("Location: index.php?error=Contraseña incorrecta");
        exit();
    }
    
        //Login correcto
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
    ?>
