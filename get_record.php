<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "reserva";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$id = $_GET['id'];

$sql = "SELECT * FROM reservas WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows > 0) {
    $record = $result->fetch_assoc();
    echo json_encode($record);
} else {
    echo json_encode([]);
}

$stmt->close();
$conn->close();
?>
