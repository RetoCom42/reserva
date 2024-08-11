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

// Obtener el nombre de la vista desde la solicitud GET
$view = $_GET['view'];

// Escapar el nombre de la tabla para evitar inyecciones SQL
$view = $conn->real_escape_string($view);

// Construir la consulta SQL
$sql = "SELECT * FROM $view";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table>";
    echo "<tr><th>No.</th><th>Unidad</th><th>Estado</th><th>Cargo</th><th>Grado</th><th>Nombre y Apellidos</th><th>Carnet de Identidad</th><th>Municipio</th><th>Dirección</th><th>Teléfono</th><th>Preparado</th><th>Fecha</th><th>Recorrido</th><th>Causal</th><th>Observaciones</th><th>Acciones</th></tr>";
    while($row = $result->fetch_assoc()) {
        echo "<tr>";
        foreach ($row as $value) {
            echo "<td>$value</td>";
        }
        echo "<td>
                <button onclick=\"viewRecord({$row['id']})\">Ver</button>
                <button onclick=\"editRecord({$row['id']})\">Editar</button>
                <button onclick=\"deleteRecord({$row['id']})\">Eliminar</button>
              </td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "No hay registros.";
}

// Cerrar la conexión
$conn->close();
?>
