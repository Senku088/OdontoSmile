
/*const mysql = require('mysql');

const conexion = mysql.createConnection({
    
})

function mostrarTratamientos(){

    var divEncabezado = document.getElementById("encabezadoMostrarTratamientos");
    var divContenido = document.getElementById("contenidoMostrarTratamientos");

    var filaEncabezado = document.createElement("tr");

    for(var i=0; i<4; i++){

    }

}*/

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