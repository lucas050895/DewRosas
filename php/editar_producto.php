<?php


    include("../config/conexion.php");


   if(isset($_POST['nombre']) && 
        isset($_POST['descripcion']) &&
        isset($_POST['precio']) &&
        isset($_POST['inventario']) &&
        isset($_POST['categoria']) &&
        isset($_POST['talla']) &&
        isset($_POST['color']) &&
        isset($_POST['destacado']  )){
    
          
            if($_FILES['imagen']['name'] !='' ){
                $carpeta="../assets/Img/";
                $nombre = $_FILES['imagen']['name'];

                    //imagen.casa.jpg
                    $temp= explode( '.' ,$nombre);
                    $extension= end($temp);
                    
                    $nombreFinal = time().'.'.$extension;
                
                    if($extension=='jpg' || $extension == 'png'){
                        if(move_uploaded_file($_FILES['imagen']['tmp_name'], $carpeta.$nombreFinal)){
                                $fila = $conexion ->query('SELECT imagen FROM productos WHERE id='.$_POST['id']);

                                $id = mysqli_fetch_row($fila);

                                if(file_exists('../assets/Img/'.$id[0])){
                                    unlink('../assets/Img/'.$id[0]);
                                }

                                $conexion->query("UPDATE productos SET imagen ='".$nombreFinal."' WHERE id=".$_POST['id']);
                        }
                    }
            }
            
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

        echo "se actualizo";


    }
?>