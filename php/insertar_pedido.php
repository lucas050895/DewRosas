<?php
    include('../config/conexion.php');

    session_start();

    if(!isset($_SESSION['carrito'])){
        header("Location: ../index.php");
    }

    $arreglo = $_SESSION['carrito'];

    $total = 0;

    for($i=0; $i<count($arreglo); $i++){
        $total = $arreglo[$i]['Precio'] * $arreglo[$i]['Cantidad'];
    }

    $re = $conexion -> query("SELECT * FROM usuario WHERE email = '".$_POST['email']."'")or die($conexion->error);
    
    $id_usuario = 0;

    if(mysqli_num_rows($re) > 0){

        $fila = mysqli_fetch_row($re);
        $id_usuario = $fila[0];
    }else{
            /*INSERTANDO DATOS EN LA TABLA USUARIOS*/
            $conexion -> query("INSERT INTO usuario(nombre,apellido,celular,email,contraseña,img_perfil,nivel)
                                    VALUES(
                                    '".$_POST['nombre']."',
                                    '".$_POST['apellido']."',
                                    '".$_POST['celular']."',
                                    '".$_POST['email']."',
                                    '".sha1($_POST['contraseña'])."',
                                    'example.jpg',
                                    'cliente'
                                    )" )or die($conexion->error);
    }




    /*INSERTANDO DATOS EN LA TABLA VENTAS*/
    $id_usuario = $conexion -> insert_id;
    $fecha = date('Y-m-d h:m:s');

    $conexion -> query("INSERT INTO ventas(id_usuario,fecha)
                                VALUES($id_usuario,'$fecha') ")or die($conexion->error);
            

    /*INSERTANDO DATOS EN LA TABLA PRODUCTOS_VENTAS*/
    $id_venta= $conexion ->insert_id ;
    for($i=0; $i<count($arreglo); $i++){
        $conexion -> query("INSERT INTO productos_venta(id_venta, id_producto, cantidad, precio, subtotal)
                                VALUES($id_venta,
                                    ".$arreglo[$i]['Id'].",
                                    ".$arreglo[$i]['Cantidad'].",
                                    ".$arreglo[$i]['Precio'].",
                                    ".$arreglo[$i]['Cantidad'] * $arreglo[$i]['Precio']."
                                                            ) ")or die($conexion->error);
        $conexion -> query("UPDATE productos 
                                SET inventario = inventario -". $arreglo[$i]['Cantidad']."
                                WHERE id = ".$arreglo[$i]['Id'] )or die($conexion->error);
    }

    include("mail.php");

    unset($_SESSION['carrito']);

    header("Location: ../links/pagar?id_venta=".$id_venta);
?>