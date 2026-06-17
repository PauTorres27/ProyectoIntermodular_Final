<?php
require_once "conexion.php";

$email = $_POST['email'];

// Buscar usuario por email
$sql = "SELECT Id_Usuario FROM usuario WHERE email = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("s", $email);
$stmt->execute();
$resultado = $stmt->get_result();

if ($resultado->num_rows === 0) {
    echo "<script>alert('No existe ninguna cuenta con ese email'); window.location='recuperar_contrasena.php';</script>";
    exit();
}

$usuario = $resultado->fetch_assoc();
$id = $usuario['Id_Usuario'];
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Cambiar Contraseña</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>

<body class="bg-light">

<div class="container mt-5" style="max-width: 450px;">
    <h3 class="text-center mb-4">Cambiar Contraseña</h3>

    <form action="actualizar_contrasena.php" method="POST">

        <input type="hidden" name="id" value="<?php echo $id; ?>">

        <label class="form-label">Nueva contraseña</label>
        <input type="password" name="pass1" class="form-control" required>

        <label class="form-label mt-3">Repetir contraseña</label>
        <input type="password" name="pass2" class="form-control" required>

        <button class="btn btn-success w-100 mt-4">Actualizar</button>

        <div class="text-center mt-3">
            <a href="index.php">Volver al inicio</a>
        </div>

    </form>
</div>

</body>
</html>
