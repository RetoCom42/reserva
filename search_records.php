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

// Obtener los parámetros de búsqueda
$query = $_GET['query'];
$view = $_GET['view'];

// Escapar los parámetros para evitar inyecciones SQL
$query = $conn->real_escape_string($query);
$view = $conn->real_escape_string($view);

// Construir la consulta SQL
$sql = "SELECT * FROM $view WHERE nombre_apellidos LIKE '%$query%' OR c_identidad LIKE '%$query%'";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<table>";
    echo "<tr><th>Unidad</th><th>Estado</th><th>Cargo</th><th>Grado</th><th>Nombre y Apellidos</th><th>Carnet de Identidad</th><th>Municipio</th><th>Dirección</th><th>Teléfono</th><th>Preparado</th><th>Fecha</th><th>Recorrido</th><th>Causal</th><th>Observaciones</th><th>Acciones</th></tr>";
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
