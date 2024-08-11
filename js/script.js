let currentView = '';

document.addEventListener('DOMContentLoaded', () => {
    function updateCounters(viewName = '') {
        fetch('get_counters.php')
            .then(response => response.json())
            .then(data => {
                document.getElementById('count_destacamento1').innerText = data.destacamento1;
                document.getElementById('count_destacamento2').innerText = data.destacamento2;
                document.getElementById('count_destacamento3').innerText = data.destacamento3;
                document.getElementById('count_destacamento4').innerText = data.destacamento4;
                document.getElementById('count_destacamento5').innerText = data.destacamento5;
                document.getElementById('count_plana_mayor').innerText = data.plana_mayor;
                document.getElementById('count_total').innerText = data.total;

                // Mostrar solo el contador correspondiente a la vista actual
                document.querySelectorAll('.counter').forEach(counter => {
                    counter.style.display = 'none';
                });

                if (viewName) {
                    document.getElementById(`counter_${viewName}`).style.display = 'block';
                } else {
                    document.querySelectorAll('.counter').forEach(counter => {
                        counter.style.display = 'block';
                    });
                }

                // Actualizar el gráfico
                updateChart(data);
            })
            .catch(error => console.error('Error al actualizar los contadores:', error));
    }

    function updateChart(data) {
        const ctx = document.getElementById('myChart').getContext('2d');
        const chart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: ['Destacamento 1', 'Destacamento 2', 'Destacamento 3', 'Destacamento 4', 'Destacamento 5', 'Plana Mayor'],
                datasets: [{
                    label: 'Cantidad de Reservas',
                    data: [data.destacamento1, data.destacamento2, data.destacamento3, data.destacamento4, data.destacamento5, data.plana_mayor],
                    backgroundColor: [
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
                    ],
                    borderColor: [
                        'rgba(75, 192, 192, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)',
                        'rgba(153, 102, 255, 1)',
                        'rgba(255, 159, 64, 1)'
                    ],
                    borderWidth: 1
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });
    }

    document.querySelectorAll('nav ul li a').forEach(link => {
        link.addEventListener('click', (event) => {
            event.preventDefault();
            const view = event.target.getAttribute('onclick').match(/'([^']+)'/)[1];
            loadView(view);
        });
    });

    const modal = document.getElementById('myModal');
    const viewModal = document.getElementById('viewModal');
    const closeModalButtons = document.querySelectorAll('.close');

    closeModalButtons.forEach(button => {
        button.addEventListener('click', () => {
            modal.style.display = 'none';
            viewModal.style.display = 'none';
        });
    });

    window.addEventListener('click', (event) => {
        if (event.target === modal) {
            modal.style.display = 'none';
        }
        if (event.target === viewModal) {
            viewModal.style.display = 'none';
        }
    });

    function openAddEditModal() {
        modal.style.display = 'block';
    }

    function openViewModal() {
        viewModal.style.display = 'block';
    }

    // Asegúrate de que los botones existan en tu HTML
    document.getElementById('someButton').addEventListener('click', openAddEditModal);
    document.getElementById('anotherButton').addEventListener('click', openViewModal);

    // Inicializar los contadores al cargar la página
    updateCounters();
    loadView('inicio');
});

function loadView(viewName) {
    currentView = viewName;
    if (viewName === 'inicio') {
        document.getElementById('content').innerHTML = `
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
        `;
        updateCounters();
    } else {
        fetch(`load_view.php?view=${viewName}`)
            .then(response => response.text())
            .then(data => {
                document.getElementById('content').innerHTML = `
                    <div class="search-container">
                        <input type="text" id="searchInput" placeholder="Buscar por Nombre o Carnet de Identidad">
                        <button onclick="searchRecords()">Buscar</button>
                        <button id="openModalBtn">Añadir Reserva</button>
                    </div>
                    ${data}
                `;
                document.getElementById('openModalBtn').onclick = function() {
                    document.getElementById('id').value = '';
                    document.getElementById('addEditReservaForm').reset();
                    document.getElementById('myModal').style.display = 'block';
                };
                updateCounters(viewName);
            })
            .catch(error => console.error('Error al cargar la vista:', error));
    }
}

function searchRecords() {
    const searchInput = document.getElementById('searchInput').value;
    fetch(`search_records.php?query=${searchInput}&view=${currentView}`)
        .then(response => response.text())
        .then(data => {
            document.getElementById('content').innerHTML = `
                <div class="search-container">
                    <input type="text" id="searchInput" placeholder="Buscar por Nombre o Carnet de Identidad">
                    <button onclick="searchRecords()">Buscar</button>
                    <button id="openModalBtn">Añadir Reserva</button>
                </div>
                ${data}
            `;
            document.getElementById('openModalBtn').onclick = function() {
                document.getElementById('id').value = '';
                document.getElementById('addEditReservaForm').reset();
                document.getElementById('myModal').style.display = 'block';
            };
            updateCounters(currentView);
        })
        .catch(error => console.error('Error al buscar registros:', error));
}

function viewRecord(id) {
    fetch(`get_record.php?id=${id}`)
        .then(response => response.json())
        .then(data => {
            let content = '';
            for (const key in data) {
                content += `<p><strong>${key}:</strong> ${data[key]}</p>`;
            }
            document.getElementById('viewContent').innerHTML = content;
            document.getElementById('viewModal').style.display = 'block';
        })
        .catch(error => console.error('Error al ver el registro:', error));
}

function editRecord(id) {
    fetch(`get_record.php?id=${id}`)
        .then(response => response.json())
        .then(data => {
            document.getElementById('id').value = data.id;
            document.getElementById('unidad').value = data.unidad;
            document.getElementById('estado').value = data.estado;
            document.getElementById('cargo').value = data.cargo;
            document.getElementById('grado').value = data.grado;
            document.getElementById('nombre_apellidos').value = data.nombre_apellidos;
            document.getElementById('c_identidad').value = data.c_identidad;
            document.getElementById('municipio').value = data.municipio;
            document.getElementById('direccion').value = data.direccion;
            document.getElementById('telefono').value = data.telefono;
            document.getElementById('preparado').checked = data.preparado;
            document.getElementById('fecha').value = data.fecha;
            document.getElementById('recorrido').value = data.recorrido;
            document.getElementById('causal').value = data.causal;
            document.getElementById('observaciones').value = data.observaciones;
            document.getElementById('myModal').style.display = 'block';
        })
        .catch(error => console.error('Error al editar el registro:', error));
}

function deleteRecord(id) {
    if (confirm("¿Estás seguro de que deseas eliminar este registro?")) {
        fetch(`delete_record.php?id=${id}`)
            .then(response => response.text())
            .then(data => {
                alert(data);
                loadView(currentView);
            })
            .catch(error => console.error('Error al eliminar el registro:', error));
    }
}

document.querySelectorAll('.close').forEach(closeBtn => {
    closeBtn.onclick = function() {
        closeBtn.parentElement.parentElement.style.display = 'none';
    };
});

window.onclick = function(event) {
    if (event.target.classList.contains('modal')) {
        event.target.style.display = 'none';
    }
};

document.getElementById('addEditReservaForm').onsubmit = function(event) {
    event.preventDefault(); // Evitar el envío del formulario por defecto

    const formData = new FormData(this);

    fetch('add_edit_reserva.php', {
        method: 'POST',
        body: formData
    })
    .then(response => response.text())
    .then(data => {
        alert(data);
        document.getElementById('myModal').style.display = 'none';
        loadView(currentView); // Recargar la vista actual
    })
    .catch(error => console.error('Error:', error));
};
