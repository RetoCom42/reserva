<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard de Reservas</title>
    <link rel="stylesheet" href="css/styles.css">
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body>
    <div class="sidebar">
        <div class="profile">
            <img src="profile.jpg" alt="Profile Picture">
            <h2>Harry Den</h2>
        </div>
        <nav>
            <ul>
                <li><a href="#" onclick="loadView('inicio')">Inicio</a></li>
                <li><a href="#" onclick="loadView('vista_destacamento1')">Destacamento 1</a></li>
                <li><a href="#" onclick="loadView('vista_destacamento2')">Destacamento 2</a></li>
                <li><a href="#" onclick="loadView('vista_destacamento3')">Destacamento 3</a></li>
                <li><a href="#" onclick="loadView('vista_destacamento4')">Destacamento 4</a></li>
                <li><a href="#" onclick="loadView('vista_destacamento5')">Destacamento 5</a></li>
                <li><a href="#" onclick="loadView('vista_plana_mayor')">Plana Mayor</a></li>
            </ul>
        </nav>
    </div>
    <div class="main-content">
        <header>
            <h1>Estado de la Plantilla</h1>
        </header>
        <section id="counters">
            <!-- Contadores -->
            <div class="counter modern" id="counter_destacamento1">Destacamento 1: <span id="count_destacamento1">0</span></div>
            <div class="counter modern" id="counter_destacamento2">Destacamento 2: <span id="count_destacamento2">0</span></div>
            <div class="counter modern" id="counter_destacamento3">Destacamento 3: <span id="count_destacamento3">0</span></div>
            <div class="counter modern" id="counter_destacamento4">Destacamento 4: <span id="count_destacamento4">0</span></div>
            <div class="counter modern" id="counter_destacamento5">Destacamento 5: <span id="count_destacamento5">0</span></div>
            <div class="counter modern" id="counter_plana_mayor">Plana Mayor: <span id="count_plana_mayor">0</span></div>
            <div class="counter modern" id="counter_total">Total: <span id="count_total">0</span></div>
        </section>
        <section id="content">
            <!-- Aquí se cargarán las vistas -->
        </section>
        <section id="chart-container">
            <canvas id="myChart"></canvas>
        </section>
    </div>
    <script src="js/script.js"></script>
</body>
</html>
