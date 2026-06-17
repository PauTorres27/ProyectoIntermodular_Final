<?php
session_start();
require_once "conexion.php";

//Admin
if (!isset($_SESSION['Id_Usuario']) || $_SESSION['rol'] !== "admin") {
    header("Location: index.php");
    exit();
}

$id = $_GET['id'];


//Obtener datos del menú
$sql = "SELECT * FROM menu WHERE Id_menu = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$menu = $stmt->get_result()->fetch_assoc();
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Editar Menú</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>

<body class="bg-light">

<div class="container mt-4">
    <h2 class="mb-4">Editar Menú</h2>

    <form action="procesar_editar_menu.php" method="POST">

       <input type="hidden" name= "id" value="<?php echo $menu['Id_menu']; ?>">

       <label class="form-label">Nombre del Menú</label>
          <input type="text" name="nombre" class="form-control"
                 value="<?php echo $menu['nombre']; ?>" required>

         <label class="form-label">Tipo</label>
          <input type="text" name="tipo" class="form-control"
                 value="<?php echo $menu['tipo']; ?>" required>

         <button class="btn btn-primary mt-3">Actualizar</button>
         <a href="menu_listar.php" class="btn btn-secondary mt-3">Volver</a>
    </form>
</div>

<div id="toast-container" class="position-fixed bottom-0 end-0 p-3" style="z-index: 9999;"></div>
<script src="validaciones.js"></script>

</body>
</html>



