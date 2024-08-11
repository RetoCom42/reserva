<?php
include 'config.php';

$sql = "SELECT * FROM empleados";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestión de Empleados</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h1>Registros de Empleados</h1>
        <table>
            <thead>
                <tr>
                    <th>No.</th>
                    <th>Unidad</th>
                    <th>Estado</th>
                    <th>Cargo</th>
                    <th>Grado</th>
                    <th>Nombre y Apellidos</th>
                    <th>C. Identidad</th>
                    <th>Municipio</th>
                    <th>Dirección</th>
                    <th># de Teléfono</th>
                    <th>Preparado</th>
                    <th>Fecha Recorrido</th>
                    <th>Causal</th>
                    <th>Observaciones</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if ($result->num_rows > 0) {
                    while($row = $result->fetch_assoc()) {
                        echo "<tr>
                            <td>" . $row["id"]. "</td>
                            <td>" . $row["unidad"]. "</td>
                            <td>" . $row["estado"]. "</td>
                            <td>" . $row["cargo"]. "</td>
                            <td>" . $row["grado"]. "</td>
                            <td>" . $row["nombre_apellidos"]. "</td>
                            <td>" . $row["c_identidad"]. "</td>
                            <td>" . $row["municipio"]. "</td>
                            <td>" . $row["direccion"]. "</td>
                            <td>" . $row["telefono"]. "</td>
                            <td>" . $row["preparado"]. "</td>
                            <td>" . $row["fecha_recorrido"]. "</td>
                            <td>" . $row["causal"]. "</td>
                            <td>" . $row["observaciones"]. "</td>
                        </tr>";
                    }
                } else {
                    echo "<tr><td colspan='14'>No hay registros</td></tr>";
                }
                $conn->close();
                ?>
            </tbody>
        </table>
        <button id="add-record">Agregar Nuevo Registro</button>
    </div>

    <!-- Modal para agregar nuevo registro -->
    <div id="addRecordModal" class="modal">
        <div class="modal-content">
            <span class="close">×</span>
            <h2>Agregar Nuevo Registro</h2>
            <form id="addRecordForm">
                <label for="unidad">Unidad:</label>
                <input type="text" id="unidad" name="unidad" required>
                <label for="estado">Estado:</label>
                <input type="text" id="estado" name="estado" required>
                <label for="cargo">Cargo:</label>
                <input type="text" id="cargo" name="cargo" required>
                <label for="grado">Grado:</label>
                <input type="text" id="grado" name="grado" required>
                <label for="nombre_apellidos">Nombre y Apellidos:</label>
                <input type="text" id="nombre_apellidos" name="nombre_apellidos" required>
                <label for="c_identidad">C. Identidad:</label>
                <input type="text" id="c_identidad" name="c_identidad" required>
                <label for="municipio">Municipio:</label>
                <input type="text" id="municipio" name="municipio" required>
                <label for="direccion">Dirección:</label>
                <input type="text" id="direccion" name="direccion" required>
                <label for="telefono"># de Teléfono:</label>
                <input type="text" id="telefono" name="telefono" required>
                <label for="preparado">Preparado:</label>
                <input type="date" id="preparado" name="preparado" required>
                <label for="fecha_recorrido">Fecha Recorrido:</label>
                <input type="date" id="fecha_recorrido" name="fecha_recorrido" required>
                <label for="causal">Causal:</label>
                <input type="text" id="causal" name="causal" required>
                <label for="observaciones">Observaciones:</label>
                <textarea id="observaciones" name="observaciones" required></textarea>
                <button type="submit">Agregar</button>
            </form>
        </div>
    </div>

    <script src="scripts.js"></script>
</body>
</html>
