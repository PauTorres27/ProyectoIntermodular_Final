<?php
include 'conexion.php';

// INSERTAR
if (isset($_POST['insertar'])) {

    $id = $_POST['id'];
    $ubicacion = $_POST['ubicacion'];
    $capacidad = $_POST['capacidad'];
    $ocupacion_min = $_POST['ocupacion_min'];
    $ocupacion_max = $_POST['ocupacion_max'];
    $tipo = $_POST['tipo'];

    // VALIDAR OCUPACIÓN
    if ($ocupacion_min > $ocupacion_max) {
        echo "<script>alert('Ocupación mínima mayor que la máxima'); window.location.href='nueva_mesa.php';</script>";
        exit();
    }

    // VALIDAR SI EL ID YA EXISTE
    $check = $conn->prepare("SELECT Id_mesa FROM mesa WHERE Id_mesa = ?");
    $check->bind_param("i", $id);
    $check->execute();
    $check->store_result();

    if ($check->num_rows > 0) {
        echo "<script>alert('El ID ya existe. Elige otro ID.'); window.location.href='listar_mesas.php';</script>";
        exit();
    }

    // INSERTAR
    $sql = "INSERT INTO mesa (Id_mesa, ubicacion, capacidad, ocupacion_min, ocupacion_max, tipo, activo)
            VALUES (?, ?, ?, ?, ?, ?, 1)";

    $stmt = $conn->prepare($sql);
    $stmt->bind_param("isiiis", $id, $ubicacion, $capacidad, $ocupacion_min, $ocupacion_max, $tipo);
    $stmt->execute();

    echo "<script>alert('Mesa añadida correctamente'); window.location.href='listar_mesas.php';</script>";
    exit();
}

// EDITAR
if (isset($_POST['editar'])) {

    $id = $_POST['id'];
    $ubicacion = $_POST['ubicacion'];
    $capacidad = $_POST['capacidad'];
    $ocupacion_min = $_POST['ocupacion_min'];
    $ocupacion_max = $_POST['ocupacion_max'];
    $tipo = $_POST['tipo'];

    if ($ocupacion_min > $ocupacion_max) {
        echo "<script>alert('Ocupación mínima mayor que la máxima'); window.location.href='editar_mesa.php?id=$id';</script>";
        exit();
    }

    $sql = "UPDATE mesa SET ubicacion=?, capacidad=?, ocupacion_min=?, ocupacion_max=?, tipo=? WHERE Id_mesa=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("siiisi", $ubicacion, $capacidad, $ocupacion_min, $ocupacion_max, $tipo, $id);
    $stmt->execute();

    echo "<script>alert('Mesa actualizada'); window.location.href='listar_mesas.php';</script>";
    exit();
}

// ELIMINAR
if (isset($_GET['eliminar'])) {

    $id = $_GET['eliminar'];

    $sql = "UPDATE mesa SET activo = 0 WHERE Id_mesa = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);
    $stmt->execute();

    echo "<script>alert('Mesa eliminada'); window.location.href='listar_mesas.php';</script>";
    exit();
}
?>
