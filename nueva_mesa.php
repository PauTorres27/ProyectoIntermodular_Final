<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Nueva Mesa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="reservas-bg">

<div class="container mt-5 p-4 bg-light rounded shadow">

    <h2 class="mb-4">Añadir Mesa</h2>

    <form action="procesar_mesa.php" method="POST">

        <div class="mb-3">
            <label class="form-label">ID Mesa</label>
            <input type="number" name="id" class="form-control" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Ubicación</label>
            <select name="ubicacion" class="form-control" required>
                <option value="Interior">Interior</option>
                <option value="Terraza">Terraza</option>
                <option value="VIP">VIP</option>
            </select>
        </div>

        <div class="mb-3">
            <label class="form-label">Capacidad</label>
            <input type="number" name="capacidad" class="form-control" min="1" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Ocupación mínima</label>
            <input type="number" name="ocupacion_min" class="form-control" min="1" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Ocupación máxima</label>
            <input type="number" name="ocupacion_max" class="form-control" min="1" required>
        </div>

        <div class="mb-3">
            <label class="form-label">Tipo</label>
            <select name="tipo" class="form-control" required>
                <option value="Normal">Normal</option>
                <option value="Redonda">Redonda</option>
                <option value="Alta">Alta</option>
                <option value="Sofá">Sofá</option>
            </select>
        </div>

        <button type="submit" name="insertar" class="btn btn-primary">Guardar</button>
        <a href="listar_mesas.php" class="btn btn-secondary">Volver</a>

    </form>

    <a href="admin.php" class="btn btn-dark mt-3">Volver al Panel de Administración</a>

</div>

</body>
</html>
