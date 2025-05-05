<?php
    include('../conexion/conexion.php');

    $nombre         =   $_POST['nombre']; 
    $apellido       =   $_POST['apellido'];
    $celular        =   $_POST['celular'];
    $email          =   $_POST['email'];
    $direccion      =   $_POST['direccion'];
    $localidad      =   $_POST['localidad'];

    if(isset($_POST['submit'])){
        $sql = "INSERT INTO clientes(nombre,apellido,celular,email,direccion,localidad) 
                VALUES ('{$nombre}','{$apellido}','{$celular}','{$email}','{$direccion}','{$localidad}')";
        mysqli_query($conexion, $sql);
    }

    // Cerrar conexión a la base de datos
    mysqli_close($conexion);

    // Redirigir a la página de exitoso
    header("Location: ../links/gracias.php");
?>
