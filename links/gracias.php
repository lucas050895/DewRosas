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

    $fecha = date('Y-m-d h:m:s');
    $conexion -> query("INSERT INTO ventas(id_usuario,total,fecha)
                                VALUES(1,$total,'$fecha') ")or die($conexion->error);

            

    $id_venta= $conexion ->insert_id ;

    for($i=0; $i<count($arreglo); $i++){
        $conexion -> query("INSERT INTO productos_venta(id_venta, id_producto, cantidad, precio, subtotal)
                                VALUES($id_venta,
                                    ".$arreglo[$i]['Id'].",
                                    ".$arreglo[$i]['Cantidad'].",
                                    ".$arreglo[$i]['Precio'].",
                                    ".$arreglo[$i]['Cantidad']*$arreglo[$i]['Precio']."
                                                            ) ")or die($conexion->error);
    }


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