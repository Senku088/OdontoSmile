<?php

    $conexion = mysqli_connect('localhost:3306', 'Dentista', 'dentista1', 'agenda');
    
    if(!$conexion){

        die("Connectio failed: ". mysqli_connect_error());

    }
    echo "Hola desde PHP";
    mysqli_close($conexion);

?>
