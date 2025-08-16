<?php
    include("../config/conexion.php");

    function procesarImagen($campo, $carpeta, $id, $conexion) {
        if (!empty($_FILES[$campo]['name'])) {
            $nombre = $_FILES[$campo]['name'];
            $temp = explode('.', $nombre);
            $extension = strtolower(end($temp));

            // Nombre único con campo + uniqid
            $nombreFinal = uniqid($campo . '_', true) . '.' . $extension;

            if (in_array($extension, ['jpg', 'png'])) {
                $rutaDestino = $carpeta . $nombreFinal;

                if (move_uploaded_file($_FILES[$campo]['tmp_name'], $rutaDestino)) {
                    // Borrado de imagen anterior
                    $res = $conexion->query("SELECT $campo FROM productos WHERE id = $id");
                    $fila = mysqli_fetch_row($res);
                    $anterior = $fila[0];

                    if ($anterior && file_exists($carpeta . $anterior)) {
                        unlink($carpeta . $anterior);
                    }

                    $conexion->query("UPDATE productos SET $campo = '$nombreFinal' WHERE id = $id");
                }
            }
        }
    }

    // Llamás la función una vez por campo
    procesarImagen('imagen2', '../assets/img/', $_POST['id'], $conexion);
    procesarImagen('imagen3', '../assets/img/', $_POST['id'], $conexion);


   if(isset($_POST['nombre']) && 
        isset($_POST['descripcion']) &&
        isset($_POST['precio']) &&
        isset($_POST['inventario']) &&
        isset($_POST['categoria']) &&
        isset($_POST['talla']) &&
        isset($_POST['color']) &&
        isset($_POST['destacado']  )){
            
            $conexion->query("UPDATE productos SET 
                                    nombre ='".$_POST['nombre']."',
                                    descripcion ='".$_POST['descripcion']."',
                                    precio =".$_POST['precio'].",
                                    inventario =".$_POST['inventario'].",
                                    id_categoria =".$_POST['categoria'].",
                                    talla ='".$_POST['talla']."',
                                    color ='".$_POST['color']."',
                                    destacado =".$_POST['destacado']."

                                    WHERE id=".$_POST['id']);

        header("Location: ../admin/productos?success");
    }
?>