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
    
    $carpeta="../assets/img/";
    $nombre = $_FILES['imagen1']['name'];
   
    //imagen.casa.jpg
    $temp= explode( '.' ,$nombre);
    $extension= end($temp);
    
    $nombreFinal = time().'.'.$extension;
   
    if($extension=='jpg' || $extension == 'png'){
        if(move_uploaded_file($_FILES['imagen1']['tmp_name'], $carpeta.$nombreFinal)){
            $conexion->query("INSERT INTO productos(nombre,
                                                    descripcion,
                                                    precio,
                                                    imagen1,
                                                    inventario,
                                                    id_categoria,
                                                    talla,
                                                    color,
                                                    destacado)
                                VALUES(
                                        '".$_POST['nombre']."',
                                        '".$_POST['descripcion']."',
                                        ".$_POST['precio'].",
                                        '$nombreFinal',
                                        '".$_POST['inventario']."',
                                        '".$_POST['categoria']."',
                                        '".$_POST['talla']."',
                                        '".$_POST['color']."',
                                        '".$_POST['destacado']."'
                )   ")or die($conexion->error);
                header("Location: ../admin/productos.php?success");
        }else{
            header("Location: ../admin/productos.php?error=no se pudo subir la imagen");
        }
    }else{
        header("Location: ../admin/productos.php?error=la imagen no es JPG o PNG");
    }

}else{
    header("Location: ../admin/productos.php?error=llenar todos los campos");
}

?>