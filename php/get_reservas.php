<?php
include 'db.php';

$id = $_GET['id'];

$sql = "SELECT * FROM reservas WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

$data = $result->fetch_assoc();

echo json_encode($data);

$stmt->close();
$conn->close();
?>
<?php
header('Content-Type: application/json');

$unidad = $_GET['unidad'];

// Conexión a la base de datos
$mysqli = new mysqli('localhost', 'usuario', 'contraseña', 'base_de_datos');

if ($mysqli->connect_error) {
    die('Error de conexión (' . $mysqli->connect_errno . ') ' . $mysqli->connect_error);
}

// Consulta para obtener las reservas de la unidad específica
$query = "SELECT * FROM reservas WHERE unidad = ?";
$stmt = $mysqli->prepare($query);
$stmt->bind_param('s', $unidad);
$stmt->execute();
$result = $stmt->get_result();

$reservas = [];
while ($row = $result->fetch_assoc()) {
    $reservas[] = $row;
}

echo json_encode($reservas);

$stmt->close();
$mysqli->close();
?>
