
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