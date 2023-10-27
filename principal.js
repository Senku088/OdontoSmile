/* ------------------------------------inicioSesion.html--------------------------------------------*/

// Estructura de datos para almacenar la información
var usuarios = [];
var citas = [];
var tratamientos = [];

// Función para iniciar sesión
function iniciarSesion() {
    // Obtener los valores del usuario y contraseña
    var usuario = document.getElementById("user").value;
    var password = document.getElementById("password").value;

    // Validar que los campos no estén vacíos
    if (usuario !== "" && password !== "") {
        // Buscar al usuario en la lista de usuarios
        var userFound = usuarios.find(function(u) {
            return u.usuario === usuario && u.password === password;
        });

        if (userFound) {
            // Iniciar sesión con éxito
            // Redirigir a la página de inicio después de iniciar sesión
            window.location.href = "paginaPrincipalOdonto.html";
        } else {
            alert("Usuario o contraseña incorrectos.");
        }
    } else {
        alert("Por favor, ingresa un usuario y contraseña.");
    }
}

/*--------------------------------registroOdonto.html y registroPaciente.html------------------------*/

// Función para registrar un nuevo usuario
function registrarUsuario() {
    // Obtener los valores de registro (nombre, contraseña, etc.)
    var nombre = document.getElementById("nombreRegistro").value;
    var usuario = document.getElementById("userRegistro").value;
    var password = document.getElementById("passwordRegistro").value;

    // Validar que los campos no estén vacíos
    if (nombre !== "" && usuario !== "" && password !== "") {
        // Crear un nuevo objeto de usuario
        var nuevoUsuario = {
            nombre: nombre,
            usuario: usuario,
            password: password
        };

        // Agregar el nuevo usuario al array de usuarios
        usuarios.push(nuevoUsuario);

        // Registrar con éxito
        alert("Usuario registrado con éxito.");
    } else {
        alert("Por favor, completa todos los campos.");
    }
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

