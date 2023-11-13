<?php

    session_start();

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
    if(isset($_POST['funcion'])){
        $funcion = $_POST['funcion'];
        switch($funcion){
            case 'mostrarNotificaciones':
                mostrarNotificaciones($conexion);
                break;
            case 'mostrarPerfil':
                mostrarPerfil($conexion);
                break;
            case 'mostrarCitas':
                mostrarCitas($conexion);
                break;
            case 'mostrarSeguimiento':
                mostrarSeguimiento($conexion);
                break;
            case 'mostrarTratamientos':
                mostrarTratamientos($conexion);
                break;
        }
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
            header('location: inicioSesion.html');
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
            header('location: inicioSesion.html');
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
            header('location: crudTratamientos.html');
        } else {
            echo "Error" . $conexion->Error;
        }
    }
    function mostrarNotificaciones($conexion){
        $nombreUsuario = $_SESSION['nombre'];

        $consulta = "USE agenda";
        mysqli_query($conexion, $consulta);
        $consulta = "SELECT * FROM dentista WHERE nombre='$nombreUsuario'";
        $resultado = mysqli_query($conexion, $consulta);

        if(mysqli_num_rows($resultado) == 1){

            $row = mysqli_fetch_assoc($resultado);
            $idUsuario = $row['idDentista'];

            $consulta = "USE agenda";
            mysqli_query($conexion, $consulta);
            $consulta = "SELECT * FROM notificaciones WHERE idDentista='$idUsuario'";
            $resultado = mysqli_query($conexion, $consulta);

            if(mysqli_num_rows($resultado) >= 1){

                while( $row = mysqli_fetch_assoc($resultado)){
                    $new_array[] = $row;
                }
                echo json_encode($new_array);

            } else {

                echo "No tienes notificaciones hasta ahora";

            }

        } else {
            
            $consulta = "USE agenda";
            mysqli_query($conexion, $consulta);
            $consulta = "SELECT * FROM paciente WHERE nombre='$nombreUsuario'";

            $resultado = mysqli_query($conexion, $consulta);

            if(mysqli_num_rows($resultado) == 1){

                $row = mysqli_fetch_assoc($resultado);
                $idUsuario = $row['idPaciente'];

                $consulta = "USE agenda";
                mysqli_query($conexion, $consulta);
                $consulta = "SELECT * FROM notificaciones WHERE idPaciente='$idUsuario'";
                $resultado = mysqli_query($conexion, $consulta);

                if(mysqli_num_rows($resultado) >= 1){

                    while( $row = mysqli_fetch_assoc($resultado)){
                        $new_array[] = $row;
                    }
                    echo json_encode($new_array);
    
                } else {
    
                    echo "No tienes notificaciones hasta ahora";
    
                }

            }  else {

                echo "Error al encontrar tu usuario";

            }
        }
    }
    function mostrarPerfil($conexion){
        $nombreUsuario = $_SESSION['nombre'];
        echo $nombreUsuario;

        $consulta = "USE agenda";
        mysqli_query($conexion, $consulta);
        $consulta = "SELECT * FROM dentista WHERE nombre='$nombreUsuario'";
        $resultado = mysqli_query($conexion, $consulta);

        if(mysqli_num_rows($resultado) == 1){

            while( $row = mysqli_fetch_assoc($resultado)){
                $new_array[] = $row;
            }
            echo json_encode($new_array);

        } else {
            
            $consulta = "USE agenda";
            mysqli_query($conexion, $consulta);
            $consulta = "SELECT * FROM paciente WHERE nombre='$nombreUsuario'";
            $resultado = mysqli_query($conexion, $consulta);

            if(mysqli_num_rows($resultado) == 1){

                while( $row = mysqli_fetch_assoc($resultado)){
                    $new_array[] = $row;
                }
                echo json_encode($new_array);

            }  else {

                echo "Que raro, no tienes informacion de tu perfil";

            }
        }
    }
    function mostrarCitas($conexion){
        $nombreUsuario = $_SESSION['nombre'];

        $consulta = "USE agenda";
        mysqli_query($conexion, $consulta);
        $consulta = "SELECT * FROM dentista WHERE nombre='$nombreUsuario'";
        $resultado = mysqli_query($conexion, $consulta);

        if(mysqli_num_rows($resultado) == 1){

            $row = mysqli_fetch_assoc($resultado);
            $idUsuario = $row['idDentista'];

            $consulta = "USE agenda";
            mysqli_query($conexion, $consulta);
            $consulta = "SELECT * FROM citas WHERE idDentista='$idUsuario'";
            $resultado = mysqli_query($conexion, $consulta);

            if(mysqli_num_rows($resultado) >= 1){

                while( $row = mysqli_fetch_assoc($resultado)){
                    $new_array[] = $row;
                }
                echo json_encode($new_array);

            } else {

                echo "No tienes ninguna cita en este momento";

            }

        } else {
            
            $consulta = "USE agenda";
            mysqli_query($conexion, $consulta);
            $consulta = "SELECT * FROM paciente WHERE nombre='$nombreUsuario'";

            $resultado = mysqli_query($conexion, $consulta);

            if(mysqli_num_rows($resultado) == 1){

                $row = mysqli_fetch_assoc($resultado);
                $idUsuario = $row['idPaciente'];

                $consulta = "USE agenda";
                mysqli_query($conexion, $consulta);
                $consulta = "SELECT * FROM citas WHERE idPaciente='$idUsuario'";
                $resultado = mysqli_query($conexion, $consulta);

                if(mysqli_num_rows($resultado) >= 1){

                    while( $row = mysqli_fetch_assoc($resultado)){
                        $new_array[] = $row;
                    }
                    echo json_encode($new_array);
    
                } else {
    
                    echo "No tienes ninguna cita en este momento";
    
                }

            }  else {

                echo "Error al encontrar tu usuario";

            }
        }
    }
    function mostrarSeguimiento($conexion){
        $nombreUsuario = $_SESSION['nombre'];

        $consulta = "USE agenda";
        mysqli_query($conexion, $consulta);
        $consulta = "SELECT * FROM dentista WHERE nombre='$nombreUsuario'";
        $resultado = mysqli_query($conexion, $consulta);

        if(mysqli_num_rows($resultado) == 1){

            $row = mysqli_fetch_assoc($resultado);
            $idUsuario = $row['idDentista'];

            $consulta = "USE agenda";
            mysqli_query($conexion, $consulta);
            $consulta = "SELECT * FROM seguimientos WHERE idDentista='$idUsuario'";
            $resultado = mysqli_query($conexion, $consulta);

            if(mysqli_num_rows($resultado) >= 1){

                while( $row = mysqli_fetch_assoc($resultado)){
                    $new_array[] = $row;
                }
                echo json_encode($new_array);

            } else {

                echo "No tienes nada en tu seguimiento";

            }

        } else {
            
            $consulta = "USE agenda";
            mysqli_query($conexion, $consulta);
            $consulta = "SELECT * FROM paciente WHERE nombre='$nombreUsuario'";

            $resultado = mysqli_query($conexion, $consulta);

            if(mysqli_num_rows($resultado) == 1){

                $row = mysqli_fetch_assoc($resultado);
                $idUsuario = $row['idPaciente'];

                $consulta = "USE agenda";
                mysqli_query($conexion, $consulta);
                $consulta = "SELECT * FROM seguimientos WHERE idPaciente='$idUsuario'";
                $resultado = mysqli_query($conexion, $consulta);

                if(mysqli_num_rows($resultado) >= 1){

                    while( $row = mysqli_fetch_assoc($resultado)){
                        $new_array[] = $row;
                    }
                    echo json_encode($new_array);
    
                } else {
    
                    echo "No tienes nada en tu seguimiento";
    
                }

            }  else {

                echo "Error al encontrar tu usuario";

            }
        }
    }
    function mostrarTratamientos($conexion){

        $consulta = "USE agenda";
        mysqli_query($conexion, $consulta);
        $consulta = "SELECT * FROM tratamientos";
        $resultado = mysqli_query($conexion, $consulta);

        if(mysqli_num_rows($resultado) >= 1){

            while( $row = mysqli_fetch_assoc($resultado)){
                $new_array[] = $row;
            }
            echo json_encode($new_array);

        } else {

            echo "No hay tratamientos para mostrar";

        }
    }

    #Se cierra la conexion con la base de datos
    mysqli_close($conexion);

?>
