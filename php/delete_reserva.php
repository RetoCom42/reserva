<?php
include 'db.php';

$id = $_GET['id'];

$sql = "DELETE FROM reservas WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);
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
