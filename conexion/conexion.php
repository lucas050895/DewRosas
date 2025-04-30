<?php
    $servidor = "localhost";
    $nombreBD = "dewrosas";
    $usuario = "root";
    $password = "";

    $conexion = new mysqli($servidor,$usuario,$password,$nombreBD);

    if($conexion -> connect_error){
        die("Error en la conexion de la BD");
    }
?>