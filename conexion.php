<?php

    $conexion = mysqli_connect('127.0.0.1:3306', 'root', '', 'agenda');
    
    if(!$conexion){

        die("Connection failed: ". mysqli_connect_error());

    }

    

    function insertar($conexion){
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

    insertar($conexion);
    
    mysqli_close($conexion);

?>
