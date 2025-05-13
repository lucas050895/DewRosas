<?php


    include("../conexion/conexion.php");


    $fila = $conexion ->query('SELECT imagen FROM productos WHERE id='.$_POST['id']);

    $id = mysqli_fetch_row($fila);

    if(file_exists('../assets/Img/'.$id[0])){
        unlink('../assets/Img/'.$id[0]);
    }

    $conexion->query("DELETE FROM productos WHERE id =".$_POST['id']);

    echo 'listo';

?>