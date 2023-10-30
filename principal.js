/* ------------------------------------inicioSesion.html--------------------------------------------*/

// Estructura de datos para almacenar la información
var usuarios = [];
var citas = [];
var tratamientos = [];

function conectarSQL(){

    var sql = require('mysql');

    var con = mysql.createConnection({
        host: "127.0.0.1:3306",
        user: "root",
        password: ""
      });
      
      con.connect(function(err) {
        if (err) throw err;
        console.log("Connected!");
      });

}

/*---------------------------------------------AgendarCita.html--------------------------------------*/

// Función para agendar una cita dental
function agendarCita() {
    // Obtener los valores de la cita (nombre, teléfono, fecha, etc.)
    var nombre = document.getElementById("nombre").value;
    var telefono = document.getElementById("telefono").value;
    var fecha = document.getElementById("fecha").value;
    var hora = document.getElementById("hora").value;

    // Validar que los campos no estén vacíos
    if (nombre !== "" && telefono !== "" && fecha !== "" && hora !== "") {
        // Crear un nuevo objeto de cita
        var nuevaCita = {
            nombre: nombre,
            telefono: telefono,
            fecha: fecha,
            hora: hora
        };

        // Agregar la nueva cita al array de citas
        citas.push(nuevaCita);

        // Mostrar mensaje de éxito
        alert("Cita agendada con éxito.");
    } else {
        alert("Por favor, completa todos los campos.");
    }
}

/*--------------------------------------------crudTratamientos.html----------------------------------*/ 

// Función para editar un tratamiento dental
function editarTratamiento(id) {
    // Obtener índice del tratamiento con el ID proporcionado
    var indiceTratamiento = tratamientos.findIndex(function(t) {
        return t.id === id;
    });

    if (indiceTratamiento !== -1) {
        // Pedir al usuario que ingrese el nuevo nombre y descripción
        var nuevoNombre = prompt("Ingrese el nuevo nombre del tratamiento:");
        var nuevaDescripcion = prompt("Ingrese la nueva descripción del tratamiento:");

        if (nuevoNombre !== null && nuevaDescripcion !== null) {
            // Actualizar el tratamiento con la nueva información
            tratamientos[indiceTratamiento].nombre = nuevoNombre;
            tratamientos[indiceTratamiento].descripcion = nuevaDescripcion;

            // Mostrar mensaje de éxito
            alert("Tratamiento editado con éxito.");
        } else {
            alert("No se ingresó información, la edición fue cancelada.");
        }
    } else {
        alert("Tratamiento no encontrado.");
    }
}

function mostrarTratamientos(){

    conectarSQL();

    /*var divEencabezado = document.getElementById("encabezadoMostrarTratamientos");
    var divContenido = document.getElementById("contenidoMostrarTratamientos");

    for(var i=0; i<3; i++){
        var fila = document.createElement("tr");

        for
    }*/

}