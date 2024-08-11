<?php
include 'db.php';

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

$sql = "UPDATE reservas SET unidad = ?, estado = ?, cargo = ?, grado = ?, nombre_apellidos = ?, c_identidad = ?, municipio = ?, direccion = ?, telefono = ?, preparado = ?, fecha = ?, recorrido = ?, causal = ?, observaciones = ? WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssssssssssssssi", $unidad, $estado, $cargo, $grado, $nombre_apellidos, $c_identidad, $municipio, $direccion, $telefono, $preparado, $fecha, $recorrido, $causal, $observaciones, $id);
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
