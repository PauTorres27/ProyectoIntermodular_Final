<?php
session_start();
require_once "conexion.php";

//Admin
if (!isset($_SESSION['Id_Usuario']) || $_SESSION['rol'] !== "admin") {
    header("Location: index.php");
    exit();
}

if (!isset($_GET['id'])) {
    header("Location: admin_usuarios.php");
    exit();
}

$id = $_GET['id'];

//Obtenemos datos del usuario
$sql = "SELECT * FROM usuario WHERE Id_Usuario = ?";
$stmt = $conn->prepare($sql);

if (!$stmt) {
    die("Error en prepare(): " . $conn->error);
}

$stmt->bind_param("i", $id);
$stmt->execute();
$resultado = $stmt->get_result();

if ($resultado->num_rows === 0) {
    header("Location: admin_usuarios.php");
    exit();
}

$usuario = $resultado->fetch_assoc();

//Si el formulario se envió
if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $nombre = $_POST['nombre'];
    $email = $_POST['email'];
    $telefono = $_POST['telefono'];
    $rol = $_POST['rol'];

    // Validar email duplicado (excepto si es el mismo del usuario actual)
    $sql_check = "SELECT * FROM usuario WHERE email = ? AND Id_Usuario != ?";
    $stmt_check = $conn->prepare($sql_check);
    $stmt_check->bind_param("si", $email, $id);
    $stmt_check->execute();
    $resultado_check = $stmt_check->get_result();

    if ($resultado_check->num_rows > 0) {
        $error = "El correo ya está registrado por otro usuario";
    } else {

        //Contraseña: si está vacía, mantenemos la actual
        if (!empty($_POST['contrasena'])) {
            $contrasena = password_hash($_POST['contrasena'], PASSWORD_DEFAULT);
        } else {
            $contrasena = $usuario['contrasena'];
        }

        //Actualizar usuario
        $sql = "UPDATE usuario SET nombre = ?, email = ?, contrasena = ?, telefono = ?, rol = ? WHERE Id_Usuario = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("sssssi", $nombre, $email, $contrasena, $telefono, $rol, $id);

        if ($stmt->execute()) {
            header("Location: admin_usuarios.php");
            exit();
        } else {
            $error = "Error al actualizar al usuario";
        }
    }
}
?>



<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title> Editar Usuario</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>

<body class="bg-light">

<div class="container mt-4">
    <h2 class="mb-4">Editar Usuario</h2>

    <?php if (isset($error)) { ?>
       <div class="alert alert-danger"><?php echo $error; ?></div>
    <?php } ?>

    <form method="POST">

       <div class="mb-3">
          <label class="form-label">Nombre</label>
          <input type="text" name="nombre" class="form-control" value="<?php echo $usuario['nombre']; ?>" required>
       </div>

       <div class="mb-3">
          <label class="form-label">Email</label>
          <input type="email" name="email" class="form-control" value="<?php echo $usuario['email']; ?>" required>
       </div>

       <div class="mb-3">
          <label class="form-label"> Nueva contraseña (opcional)</label>
          <input type="password" name="contrasena" class="form-control" placeholder="Déjalo vacio para mantener la actual">
       </div>

       <div class="mb-3">
          <label class="form-label">Teléfono</label>
          <input type="text" name="telefono" class="form-control" value="<?php echo $usuario['telefono']; ?>">
       </div>

       <div class="mb-3">
          <label class="form-label">Rol</label>
          <select name="rol" class="form-select" required>
            <option value="usuario" <?php if ($usuario['rol'] === 'usuario') echo 'selected'; ?>>Usuario</option>
            <option value="admin" <?php if ($usuario['rol'] === 'admin') echo 'selected'; ?>>Administrador</option>
          </select>
       </div>

         <button type="submit" class="btn btn-warning">Guardar Cambios</button>
       <a href="admin_usuarios.php" class="btn btn-secondary">Cancelar</a>

    </form>
</div>

<div id="toast-container" class="position-fixed bottom-0 end-0 p-3" style="z-index: 9999;"></div>
<script src="validaciones.js"></script>

</body>
</html>