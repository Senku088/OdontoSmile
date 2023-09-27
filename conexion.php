<?php

    $conexion = mysqli_connect('nombreservidor o ip', 'usuario', 'password', 'nombrebasededatos');
    
    if(!$conexion){

        die("Connectio failed: ". mysqli_connect_error());

    }
    echo "Hola desde PHP";
    mysqli_close($conexion);

?>
