<?php

    #Conexion a la base de datos aun en servidor local
    $conexion = mysqli_connect('127.0.0.1:3306', 'root', '', 'agenda');
    
    #Metodo para matar la conexion en caso de que no se encuentre
    if(!$conexion){

        die("Connection failed: ". mysqli_connect_error());

    }

    #If's que se ejecutan cuando se presionan ciertos botones
    if(isset($_POST['botonRegistroO'])){
        insertarOdonto($conexion);
    }
    if(isset($_POST['botonRegistroP'])){
        insertarPaciente($conexion);
    }
    if(isset($_POST['botonInicioSesion'])){
        iniciarSesion($conexion);
    }
    if(isset($_POST['botonAgregarTratamiento'])){
        insertarTratamiento($conexion);
    }

    #Declaracion de las funciones para insertar o consultar en la base de datos
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

            if($contrasena == $row['contrasena']){

                $_SESSION['nombre'] = $nombre;
                header('location: paginaPrincipalOdonto.html');

            } else {

                echo "Contraseña incorrecta";

            }

        } else {
            
            $consulta = "USE agenda";
            mysqli_query($conexion, $consulta);
            $consulta = "SELECT * FROM paciente WHERE nombre='$nombre'";

            $resultado = mysqli_query($conexion, $consulta);

            if(mysqli_num_rows($resultado) == 1){

                $row = mysqli_fetch_assoc($resultado);

                if($contrasena == $row['contrasena']){

                    $_SESSION['nombre'] = $nombre;
                    header('location: paginaPrincipalPaciente.html');

                } else {

                    echo "Contraseña incorrecta";

                }

            }  else {

                echo "<script language='javascript'>alert('Error al iniciar sesion');history.back();</script>";

            }
        }
    }
    function insertarTratamiento($conexion){
        
        $nombre = $_POST['nombreTratamiento'];
        $descripcion = $_POST['descripcionTratamiento'];

        $consulta = "USE agenda";
        mysqli_query($conexion, $consulta);
        $consulta = "INSERT INTO tratamientos (nombre, descripcion) VALUES ('$nombre', '$descripcion')";
        
        if ($conexion->query($consulta) === TRUE){
            echo "Exito";
        } else {
            echo "Error" . $conexion->Error;
        }
    }
    
    #Se cierra la conexion con la base de datos
    mysqli_close($conexion);

?>
