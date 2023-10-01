<?php

    $conexion = mysqli_connect('127.0.0.1:3306', 'root', '', 'agenda');
    
    if(!$conexion){

        die("Connection failed: ". mysqli_connect_error());

    }

    $consulta = "USE agenda";
    mysqli_query($conexion, $consulta);
    $consulta = "SELECT * FROM dentista";
    $resultado = mysqli_query($conexion, $consulta);

    while($file = )
    echo mysqli_fetch_array($resultado)['id'];
    echo mysqli_fetch_array($resultado)['nombre'];
    echo mysqli_fetch_array($resultado)['especialidad'];
    echo mysqli_fetch_array($resultado)['correo'];
    echo mysqli_fetch_array($resultado)['telefono'];

    mysqli_close($conexion);

?>
