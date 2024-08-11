<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "reserva";

// Crear conexión
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar conexión
if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

// Obtener el ID del registro
$id = $_GET['id'];

// Obtener el registro
$stmt = $conn->prepare("SELECT * FROM reservas WHERE id=?");
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
