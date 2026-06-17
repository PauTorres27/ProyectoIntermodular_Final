<?php
include 'conexion.php';

if (!isset($_GET['id'])) {
    echo "<script>alert('ID no especificado'); window.location.href='listar_mesas.php';</script>";
    exit();
}

$id = $_GET['id'];

$sql = "SELECT * FROM mesa WHERE Id_mesa = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$res = $stmt->get_result();

if ($res->num_rows == 0) {
    echo "<script>alert('Mesa no encontrada'); window.location.href='listar_mesas.php';</script>";
    exit();
}

$mesa = $res->fetch_assoc();
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Mesa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="reservas-bg">

<div class="container mt-5 p-4 bg-light rounded shadow">
    <h2 class="mb-4">Editar Mesa</h2>

    <form action="procesar_mesa.php" method="POST">

        <input type="hidden" name="id" value="<?= $mesa['Id_mesa'] ?>">

        <div class="mb-3">
            <label class="form-label">Ubicación</label>
            <select name="ubicacion" class="form-control">
                <option value="Interior" <?= $mesa['ubicacion']=='Interior'?'selected':'' ?>>Interior</option>
                <option value="Terraza" <?= $mesa['ubicacion']=='Terraza'?'selected':'' ?>>Terraza</option>
                <option value="VIP" <?= $mesa['ubicacion']=='VIP'?'selected':'' ?>>VIP</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Capacidad</label>
            <input type="number" name="capacidad" class="form-control" value="<?= $mesa['capacidad'] ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Ocupación mínima</label>
            <input type="number" name="ocupacion_min" class="form-control" value="<?= $mesa['ocupacion_min'] ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Ocupación máxima</label>
            <input type="number" name="ocupacion_max" class="form-control" value="<?= $mesa['ocupacion_max'] ?>" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Tipo</label>
            <select name="tipo" class="form-control">
                <option value="Normal" <?= $mesa['tipo']=='Normal'?'selected':'' ?>>Normal</option>
                <option value="Redonda" <?= $mesa['tipo']=='Redonda'?'selected':'' ?>>Redonda</option>
                <option value="Alta" <?= $mesa['tipo']=='Alta'?'selected':'' ?>>Alta</option>
                <option value="Sofá" <?= $mesa['tipo']=='Sofá'?'selected':'' ?>>Sofá</option>
            </select>
        </div>

        <button type="submit" name="editar" class="btn btn-primary">Guardar Cambios</button>
        <a href="listar_mesas.php" class="btn btn-secondary">Volver</a>

    </form>
</div>

</body>
</html>
