<?php
    if(isset($_GET['id_venta']) && isset($_GET['metodo'])) {
        
        include("../conexion/conexion.php");

        $conexion->query("INSERT INTO pagos (id_venta, metodo)
                            VALUES (".$_GET['id_venta'].", ".$_GET['metodo'].")") or die($conexion->error);

        header("Location: gracias.php?id_venta=".$_GET['id_venta']);
        
        exit();
    }

?>
<!DOCTYPE html>
<html lang="es">
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