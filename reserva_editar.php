<?php
session_start();
require_once "conexion.php";

// Solo admin
if (!isset($_SESSION['Id_Usuario']) || $_SESSION['rol'] !== "admin") {
    header("Location: index.php");
    exit();
}

// Validar ID
if (!isset($_GET['id']) || empty($_GET['id'])) {
    header("Location: admin_reservas.php");
    exit();
}

$id = intval($_GET['id']);

// Obtener datos de la reserva
$sql = "SELECT * FROM reserva WHERE Id_Reserva = ?";
$stmt = $conn->prepare($sql);

if (!$stmt) {
     die("Error en prepare(): " . $conn->error); 
}

$stmt->bind_param("i", $id);
$stmt->execute();
$reserva = $stmt->get_result()->fetch_assoc();

if (!$reserva) {
    header("Location: admin_reservas.php");
    exit();
}

// Obtener usuarios
$sqlUsuarios = "SELECT Id_Usuario, nombre FROM usuario";
$usuarios = $conn->query($sqlUsuarios);

// Obtener mesas (solo Id_mesa)
$sqlMesas = "SELECT Id_mesa FROM mesa";
$mesas = $conn->query($sqlMesas);
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Editar Reserva</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css">
</head>

<body class="bg-light">

<div class="container mt-4">
    <h2 class="mb-4">Editar Reserva</h2>

    <form action="procesar_editar_reserva.php" method="POST">

        <input type="hidden" name="id" value="<?php echo $reserva['Id_Reserva']; ?>">

        <!-- Usuario -->
        <label class="form-label">Usuario</label>
        <select name="Id_Usuario" class="form-control" required>
            <?php while ($u = $usuarios->fetch_assoc()) { ?>
                <option value="<?php echo $u['Id_Usuario']; ?>"
                    <?php if ($u['Id_Usuario'] == $reserva['Id_Usuario']) echo "selected"; ?>>
                    <?php echo $u['nombre']; ?>
                </option>
            <?php } ?>
        </select>

        <!-- Mesa -->
        <label class="form-label mt-3">Mesa</label>
        <select name="Id_mesa" class="form-control" required>
            <?php while ($m = $mesas->fetch_assoc()) { ?>
                <option value="<?php echo $m['Id_mesa']; ?>"
                    <?php if ($m['Id_mesa'] == $reserva['Id_mesa']) echo "selected"; ?>>
                    Mesa <?php echo $m['Id_mesa']; ?>
                </option>
            <?php } ?>
        </select>

        <!-- Fecha -->
        <label class="form-label mt-3">Fecha</label>
        <input type="date" name="fecha" class="form-control"
               value="<?php echo $reserva['fecha']; ?>" required>

        <!-- Hora -->
        <label class="form-label mt-3">Hora</label>
        <input type="time" name="hora" class="form-control"
               value="<?php echo $reserva['hora']; ?>" required>

        <!-- Número de personas -->
        <label class="form-label mt-3">Número de Personas</label>
        <input type="number" name="n_personas" class="form-control"
               value="<?php echo $reserva['n_personas']; ?>" min="1" required>

        <!-- Estado -->
        <label class="form-label mt-3">Estado</label>
        <select name="estado" class="form-control" required>
            <option value="pendiente"   <?php if ($reserva['estado'] == "pendiente") echo "selected"; ?>>Pendiente</option>
            <option value="confirmada" <?php if ($reserva['estado'] == "confirmada") echo "selected"; ?>>Confirmada</option>
            <option value="cancelada"  <?php if ($reserva['estado'] == "cancelada") echo "selected"; ?>>Cancelada</option>
        </select>

        <button class="btn btn-primary mt-4">Actualizar</button>
        <a href="admin_reservas.php" class="btn btn-secondary mt-4">Volver</a>

    </form>
</div>

</body>
</html>
