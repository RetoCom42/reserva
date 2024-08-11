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

$sql = "DELETE FROM reservas WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    echo "Registro eliminado correctamente.";
} else {
    echo "Error al eliminar el registro: " . $conn->error;
}

$stmt->close();
$conn->close();
?>

