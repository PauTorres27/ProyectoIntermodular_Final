<?php
session_start();
require_once "conexion.php";

//Admin
if (!isset($_SESSION['Id_Usuario']) || $_SESSION['rol'] !== "admin") {
    header("Location: index.php");
    exit();
}

//Obtener usuarios
$sqlUsuarios = "SELECT Id_Usuario, nombre FROM usuario";
$usuarios = $conexion->query($sqlUsuarios);


//Obtener mesas
$sqlMesas = "SELECT Id_mesa, numero_mesa FROM mesa";
$mesas = $conexion->query($sqlMesas);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Crear Reserva</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>

<body class="bg-light">

<div class="container mt-4">
    <h2 class="mb-4">Crear Reserva</h2>

    <form action="procesar_crear_reserva.php" method="POST" class="mt-3">

       <!--Usuario--> 
       <label class="form-label">Usuario</label>
       <select name="Id_Usuario" class="form-control" required>
          <option value="">Selecciona un usuario</option>
          <?php while ($u = $usuarios->fetch_assoc()) { ?> 
              <option value="<?php echo $u['Id_Usuario']; ?>"> 
                  <?php echo $u['nombre']; ?>
              </option> 
          <?php } ?> 
        </select> 
    
       <!--Mesa--> 
       <label class="form-label mt-3">Mesa</label>
       <select name="Id_mesa" class="form-control" required>
           <option value="">Selecciona una mesa</option>
           <?php while ($m = $mesas->fetch_assoc()) { ?>
           <option value="<?php echo $m['Id_mesa']; ?>">
                Mesa <?php echo $m['numero_mesa']; ?>
            </option>
            <?php } ?>
        </select>


    <!--Fecha-->
    <label class="form-label">Fecha</label>
        <input type="date" name="fecha" class="form-control" required>

    
    <!--Hora-->
    <label class="form-label">Hora</label>
        <input type="time" name="hora" class="form-control" required>

    <!--Número de personas-->
    <label class="form-label">Número de Personas</label>
        <input type="number" name="n_personas" class="form-control" min="1" required>
    
    <!--Estado-->
    <label class="form-label mt-3">Estado</label>
        <select name="estado" class="form-control" required>
            <option value="pendiente">Pendiente</option>
            <option value="confirmada">Confirmada</option>
            <option value="cancelada">Cancelada</option>
        </select>

        <button class="btn btn-success mt-4">Guardar</button>
       <a href="reserva_listar.php" class="btn btn-secondary mt-4">Volver</a>
    </form>
</div>

<div id="toast-container" class="position-fixed bottom-0 end-0 p-3" style="z-index: 9999;"></div>
<script src="validaciones.js"></script>

</body>
</html>