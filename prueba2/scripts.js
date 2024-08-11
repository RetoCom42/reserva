// Obtener elementos del DOM
var modal = document.getElementById("addRecordModal");
var btn = document.getElementById("add-record");
var span = document.getElementsByClassName("close")[0];

// Abrir el modal al hacer clic en el botón
btn.onclick = function() {
    modal.style.display = "block";
}

// Cerrar el modal al hacer clic en la "x"
span.onclick = function() {
    modal.style.display = "none";
}

// Cerrar el modal al hacer clic fuera del contenido del modal
window.onclick = function(event) {
    if (event.target == modal) {
        modal.style.display = "none";
    }
}

// Manejar el envío del formulario
document.getElementById("addRecordForm").onsubmit = function(event) {
    event.preventDefault();
    // Aquí puedes agregar el código para enviar los datos del formulario al servidor
    modal.style.display = "none";
}
