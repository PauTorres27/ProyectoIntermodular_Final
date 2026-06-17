<?php
include 'conexion.php';

//Datos del formulario
$nombre = $_POST['nombre'];
$email = $_POST['email'];
$telefono = $_POST['telefono'];
$password = $_POST['password'];


//Validar campos vacíos
if (empty($nombre) || empty($email) || empty($telefono) || empty($password)) {
    echo "<script>alert('Todos los campos son obligatorios'); window.location.href='registro.php';</script>";
    exit();
}

//Validar email correcto
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo "<script>alert('El formato del correo no es válido'); window.location.href='registro.php';</script>";
    exit();
}

//Validar teléfono, solo números y 9 dígitos
if (!preg_match('/^[0-9]{9}$/', $telefono)) {
    echo "<script>alert('El teléfono debe tener exactamente 9 números'); window.location.href='registro.php';</script>";
    exit();
}


//Encriptar la contraseña
$password_hash = password_hash($password, PASSWORD_DEFAULT);


//Comprobamos si el email ya existe
$sql_check = "SELECT * FROM usuario WHERE email = ?";
$stmt_check = $conn->prepare($sql_check);
$stmt_check->bind_param("s", $email);
$stmt_check->execute();
$resultado = $stmt_check->get_result();

if ($resultado->num_rows > 0) {
    echo "<script>alert('El correo ya está registrado'); window.location.href='registro.php';</script>";
    exit();
}


//Inserta el nuevo usuario con contraseña encriptada
$sql_insert = "INSERT INTO usuario (nombre, email, contrasena, telefono, rol)
               VALUES (?, ?, ?, ?, 'usuario')";

$stmt_insert = $conn->prepare($sql_insert);
$stmt_insert->bind_param("ssss", $nombre, $email, $password_hash, $telefono);

if ($stmt_insert->execute()) {
    echo "<script>alert('Registro completado con éxito, ahora ya puedes iniciar sesión');
              window.location.href='index.php';
          </script>";
} else {
    echo "Error al registrar usuario: " . $conn->error;
}

$stmt_insert->close();
$conn->close();
?>