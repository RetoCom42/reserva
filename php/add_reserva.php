<?php
include 'db.php'; // Asegúrate de que la ruta es correcta

// Verifica que la conexión se haya establecido
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Recibir datos del formulario
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

// Preparar y ejecutar la consulta
$sql = "INSERT INTO reservas (unidad, estado, cargo, grado, nombre_apellidos, c_identidad, municipio, direccion, telefono, preparado, fecha, recorrido, causal, observaciones) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
if ($stmt === false) {
    die("Error en la preparación de la consulta: " . $conn->error);
}
$stmt->bind_param("ssssssssssssss", $unidad, $estado, $cargo, $grado, $nombre_apellidos, $c_identidad, $municipio, $direccion, $telefono, $preparado, $fecha, $recorrido, $causal, $observaciones);
$stmt->execute();

$response = array();
if ($stmt->affected_rows > 0) {
    $response['success'] = true;
} else {
    $response['success'] = false;
}

echo json_encode($response);

$stmt->close();
$conn->close();
?>

