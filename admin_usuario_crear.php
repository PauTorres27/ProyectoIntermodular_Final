<?php
session_start();
require_once "conexion.php";

//Admin
if (!isset($_SESSION['Id_Usuario']) || $_SESSION['rol'] !== "admin") {
    header("Location: index.php");
    exit();
}

//Si el formulario se envió
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
$nombre = $_POST['nombre'];
$email = $_POST['email'];
$contrasena = $_POST['contrasena'];
$telefono = $_POST['telefono'];
$rol = $_POST['rol'];

//Comprobar si el email ya existe
$sql_check = "SELECT * FROM usuario WHERE email = ?";
$stmt_check = $conn->prepare($sql_check);
$stmt_check->bind_param("s", $email);
$stmt_check->execute();
$resultado_check = $stmt_check->get_result();

if ($resultado_check->num_rows > 0) {
   $error = "El correo ya esta registrado. No se puede crear otro usuario con el mismo email";
} else {

   //Encriptar contraseña
   $contrasena_hash = password_hash($contrasena, PASSWORD_DEFAULT);



//Insertar usuario
$sql = "INSERT INTO usuario (nombre, email, contrasena, telefono, rol) VALUES (?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);

if (!$stmt) {
     die("Error en prepare(): " . $conn->error); 
}

$stmt->bind_param("sssss", $nombre, $email, $contrasena_hash, $telefono, $rol);

if ($stmt->execute()) {
    header("Location: admin_usuarios.php");
    exit();
} else {
    $error = "Error al crear usuario";
}
}

}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> Crear Usuario</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>

<body class="bg-light">

<div class="container mt-4">
    <h2 class="mb-4">Crear Usuario</h2>

    <?php if (isset($error)) { ?>
       <div class="alert alert-danger"><?php echo $error; ?></div>
    <?php } ?>

    <form method="POST">

       <div class="mb-3">
          <label class="form-label">Nombre</label>
          <input type="text" name="nombre" class="form-control" required>
       </div>

       <div class="mb-3">
          <label class="form-label">Email</label>
          <input type="email" name="email" class="form-control" required>
       </div>

       <div class="mb-3">
          <label class="form-label">Contraseña</label>
          <input type="password" name="contrasena" class="form-control" required>
       </div>

       <div class="mb-3">
          <label class="form-label">Teléfono</label>
          <input type="text" name="telefono" class="form-control">
       </div>

       <div class="mb-3">
          <label class="form-label">Rol</label>
          <select name="rol" class="form-select" required>
            <option value="usuario">Usuario</option>
            <option value="admin">Administrador</option>
          </select>
       </div>

       <button type="submit" class="btn btn-success">Crear Usuario</button>
       <a href="admin_usuarios.php" class="btn btn-secondary">Cancelar</a>

    </form>
</div>

<div id="toast-container" class="position-fixed bottom-0 end-0 p-3" style="z-index: 9999;"></div>
<script src="validaciones.js"></script>

</body>
</html>





