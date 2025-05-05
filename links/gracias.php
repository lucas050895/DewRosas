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
    $conexion -> query("INSERT INTO usuario(nombre,apellido,celular,email,contraseña)
                            VALUES(
                            '".$_POST['nombre']."',
                            '".$_POST['apellido']."',
                            '".$_POST['celular']."',
                            '".$_POST['email']."',
                            '".sha1($_POST['contraseña'])."'
                            )" )or die($conexion->error);


    /*INSERTANDO DATOS EN LA TABLA VENTAS*/
    $id_usuario = $conexion -> insert_id;
    $fecha = date('Y-m-d h:m:s');
    $conexion -> query("INSERT INTO ventas(id_usuario,total,fecha)
                                VALUES($id_usuario,$total,'$fecha') ")or die($conexion->error);
            

    /*INSERTANDO DATOS EN LA TABLA PRODUCTOS_VENTAS*/
    $id_venta= $conexion ->insert_id ;
    for($i=0; $i<count($arreglo); $i++){
        $conexion -> query("INSERT INTO productos_venta(id_venta, id_producto, cantidad, precio, subtotal)
                                VALUES($id_venta,
                                    ".$arreglo[$i]['Id'].",
                                    ".$arreglo[$i]['Cantidad'].",
                                    ".$arreglo[$i]['Precio'].",
                                    ".$arreglo[$i]['Cantidad']*$arreglo[$i]['Precio']."
                                                            ) ")or die($conexion->error);
        $conexion -> query("UPDATE productos 
                                SET inventario = inventario -". $arreglo[$i]['Cantidad']."
                                WHERE id = ".$arreglo[$i]['Id'] )or die($conexion->error);
    }


    /*INSERTANDO DATOS EN LA TABLA CLIENTES*/
    $conexion -> query("INSERT INTO clientes(nombre,apellido,celular,direccion, localidad, email, id_venta)
                            VALUES(
                            '".$_POST['nombre']."',
                            '".$_POST['apellido']."',
                            '".$_POST['celular']."',
                            '".$_POST['direccion']."',
                            '".$_POST['localidad']."',
                            '".$_POST['email']."',
                            $id_venta
                            )" )or die($conexion->error);


    unset($_SESSION['carrito']);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <?php
        include('../layout/meta.php');
    ?>

    <title>Gracias - Dew Rosas</title>

    <link rel="stylesheet" href="../css/realizar_pedido.css">

    <!-- FONTAWESOME  -->
    <script src="https://kit.fontawesome.com/439ee37b3b.js" crossorigin="anonymous"></script>
    <!-- BOXICONS  -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>
</head>
<body>
    <?php
        include('../layout/header.php');
    ?>

    <main>
        <div>
            <h2>¡Gracias por su compra!</h2>
            <span>Nos comunicaremos a la brevedad con usted para coordinar la entrega y el pago.</span>
        </div>
        <div>
            <p>Descargar tu factura en PDF</p>
        </div>
    </main>

    <?php
        include('../layout/footer.php');
    ?>
    
</body>
</html>