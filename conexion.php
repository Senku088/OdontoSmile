<?php

    $conexion = mysqli_connect('127.0.0.1:3306', 'root', '', 'agenda');
    
    if(!$conexion){

        die("Connection failed: ". mysqli_connect_error());

    }

    if(isset($_POST['botonRegistroO'])){
        insertarOdonto($conexion);
    }
    if(isset($_POST['botonRegistroP'])){
        insertarPaciente($conexion);
    }
    if(isset($_POST['botonInicioSesion'])){
        iniciarSesion($conexion);
    }

    function insertarOdonto($conexion){
        $nombre = $_POST['nombreRegistroO'];
        $contrasena = $_POST['contrasenaRegistroO'];
        $especialidad = $_POST['especialidadRegistroO'];
        $correo = $_POST['correoRegistroO'];
        $telefono = $_POST['telefonoRegistroO'];

        $consulta = "USE agenda";
        mysqli_query($conexion, $consulta);
        $consulta = "INSERT INTO dentista (nombre, Contrasena, especialidad, correo, telefono) VALUES ('$nombre', '$contrasena', '$especialidad', '$correo', '$telefono')";
        #mysqli_query($conexion, $consulta);

        if ($conexion->query($consulta) === TRUE){
            echo "Exito";
        } else {
            echo "Error" . $conexion->Error;
        }
    }

    function insertarPaciente($conexion){
        $nombre = $_POST['nombreRegistroP'];
        $contrasena = $_POST['contrasenaRegistroP'];
        $direccion = $_POST['direccionRegistroP'];
        $correo = $_POST['correoRegistroP'];
        $telefono = $_POST['telefonoRegistroP'];

        $consulta = "USE agenda";
        mysqli_query($conexion, $consulta);
        $consulta = "INSERT INTO paciente (nombre, contrasena, direccion, correo, telefono) VALUES ('$nombre', '$contrasena', '$direccion', '$correo', '$telefono')";

        if ($conexion->query($consulta) === TRUE){
            echo "Exito";
        } else {
            echo "Error" . $conexion->Error;
        }
    }
    function iniciarSesion($conexion){
        $nombre = $_POST['userSesion'];
        $contrasena = $_POST['passwordSesion'];

        $consulta = "USE agenda";
        mysqli_query($conexion, $consulta);
        $consulta = "SELECT * FROM dentista WHERE nombre='$nombre'";

        $resultado = mysqli_query($conexion, $consulta);

        if(mysqli_num_rows($resultado) == 1){
            $row = mysqli_fetch_assoc($resultado);
            echo $row['nombre']." ".$row['contrasena']."\n".$nombre." ".$contrasena."\n";
            if($contrasena == $row['contrasena']){
                $_SESSION['nombre'] = $nombre;
                header('location: AgendarCita.html');
            } else {
                echo "Contraseña incorrecta";
            }
        } else {
            echo "Usuario no encontrado";
        }

        /*if ($conexion->query($consulta) === TRUE){
            echo "Exito";
        } else {
            echo "Error" . $conexion->Error;
        }*/
    }
    
    mysqli_close($conexion);

?>
