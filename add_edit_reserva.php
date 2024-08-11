<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "reserva";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$id = $_POST['id'];
$unidad = $_POST['unidad'];
$estado = $_POST['estado'];
$cargo = $_POST['cargo'];
$grado = $_POST['grado'];
$nombre_apellidos = $_POST['nombre_apellidos'];
$c_identidad = $_POST['c_identidad'];
$municipio = $_POST['municipio'];
$direccion = $_POST['direccion'];
$telefono = $_POST['telefono'];
$preparado = isset($_POST['preparado']) ? 1 : 0;
$fecha = $_POST['fecha'];
$recorrido = $_POST['recorrido'];
$causal = $_POST['causal'];
$observaciones = $_POST['observaciones'];

if (empty($id)) {
    // Agregar nuevo registro
    $sql = "INSERT INTO reservas (unidad, estado, cargo, grado, nombre_apellidos, c_identidad, municipio, direccion, telefono, preparado, fecha, recorrido, causal, observaciones) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssssssssss", $unidad, $estado, $cargo, $grado, $nombre_apellidos, $c_identidad, $municipio, $direccion, $telefono, $preparado, $fecha, $recorrido, $causal, $observaciones);
} else {
    // Editar registro existente
    $sql = "UPDATE reservas SET unidad = ?, estado = ?, cargo = ?, grado = ?, nombre_apellidos = ?, c_identidad = ?, municipio = ?, direccion = ?, telefono = ?, preparado = ?, fecha = ?, recorrido = ?, causal = ?, observaciones = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssssssssssssssi", $unidad, $estado, $cargo, $grado, $nombre_apellidos, $c_identidad, $municipio, $direccion, $telefono, $preparado, $fecha, $recorrido, $causal, $observaciones, $id);
}

if ($stmt->execute()) {
    echo "Registro guardado correctamente.";
} else {
    echo "Error al guardar el registro: " . $conn->error;
}

$stmt->close();
$conn->close();
?>
