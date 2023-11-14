
const contrasena = document.getElementById("passwordSesion");
const botonIniciarSesion = document.getElementById("botonInicioSesion");
var divInputPass = document.getElementsByClassName("iniciarSesionPass");

contrasena.addEventListener('click', ()=>{
    if(contrasena.value.length < 8){
        var nuevoElemento = document.createElement("p");
        nuevoElemento.textContent = "Contraseña incorrecta";
        divInputPass.appendChild(nuevoElemento);
    }
});

document.getElementById('buttonAccesibilidad').addEventListener('click', function() {
    var accessibilityPanel = document.querySelector('.panelAccesibilidad');
    accessibilityPanel.style.display = (accessibilityPanel.style.display === 'block') ? 'none' : 'block';
    });

    function invertColors() {
    document.body.style.filter = "invert(100%)";
    }

    function applyFilter(filter) {
    document.body.style.filter = filter;
    }

    function enableScreenReader() {
    var screenReaderStatus = document.body.getAttribute('aria-live');

        if(screenReaderStatus === 'assertive') {
                // Si ya está activo, desactívalo
                document.body.setAttribute('aria-live', 'off');
                alert('Lector de pantalla desactivado.');
        } else {
            // Si está inactivo, actívalo
            document.body.setAttribute('aria-live', 'assertive');
            alert('Lector de pantalla activado. Puedes comenzar a utilizar tu lector de pantalla ahora.');
        }
    }

    function toggleReadMode() {
    var body = document.body;
    body.classList.toggle('read-mode');

    }

    function changeFontSize(size) {
        document.body.style.fontSize = size;
    }

    function changeLetterSpacing(spacing) {
        document.body.style.letterSpacing = spacing;
    }

    function changeFontSize(value) {
        document.body.style.fontSize = value + 'px';
    }

    function changeLetterSpacing(value) {
        document.body.style.letterSpacing = value + 'px';
    }