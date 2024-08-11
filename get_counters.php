<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "reserva";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Conexión fallida: " . $conn->connect_error);
}

$counters = [
    'destacamento1' => 0,
    'destacamento2' => 0,
    'destacamento3' => 0,
    'destacamento4' => 0,
    'destacamento5' => 0,
    'plana_mayor' => 0,
    'total' => 0
];

$sql = "SELECT unidad, COUNT(*) as count FROM reservas GROUP BY unidad";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while($row = $result->fetch_assoc()) {
        switch ($row['unidad']) {
            case 'Destacamento 1':
                $counters['destacamento1'] = $row['count'];
                break;
            case 'Destacamento 2':
                $counters['destacamento2'] = $row['count'];
                break;
            case 'Destacamento 3':
                $counters['destacamento3'] = $row['count'];
                break;
            case 'Destacamento 4':
                $counters['destacamento4'] = $row['count'];
                break;
            case 'Destacamento 5':
                $counters['destacamento5'] = $row['count'];
                break;
            case 'Plana Mayor':
                $counters['plana_mayor'] = $row['count'];
                break;
        }
        $counters['total'] += $row['count'];
    }
}

$conn->close();

echo json_encode($counters);
?>
