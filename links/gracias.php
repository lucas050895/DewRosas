<?php
    include('../conexion/conexion.php');

    session_start();

    if(!isset($_SESSION['carrito'])){
        header("Location: ../index.php");
    }

    $arreglo = $_SESSION['carrito'];

    $total = 0;

    for($i=0; $i<count($arreglo); $i++){
        $total = $arreglo[$i]['Precio'] * $arreglo[$i]['Cantidad'];
    }

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

    include("../php/mail.php");

    unset($_SESSION['carrito']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <!-- META -->
    <?php include('../layout/meta.php');?>

    <!-- TITULO -->
    <title>Gracias - Dew Rosas</title>

    <!-- ESTILOS -->
    <link rel="stylesheet" href="../css/gracias.css">

    <!-- ICONOS -->
    <?php include('../layout/iconos.php'); ?>
</head>
<body>
    <!-- HEADER -->
    <?php include('../layout/header.php'); ?>

    <!-- CONTENIDO -->
    <main>
        <div>
            <h2>¡Gracias por su compra!</h2>
            <span>Nos comunicaremos a la brevedad con usted para coordinar la entrega y el pago.</span>
        </div>
        <div>
            <p>Ya se envio los datos de la compra por email.</p>
        </div>
    </main>

    <!-- FOOTER -->
    <?php include('../layout/footer.php');?>  

    
    <!-- SCRIPT DEL MENU -->
    <script src="../js/menu.js"></script>
</body>
</html>