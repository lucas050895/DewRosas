<?php
    include('../conexion/conexion.php');

    if(!isset($_GET['id_venta'])){
        header('Location ../index.php');
    }

    $datos = $conexion->query("SELECT 
                                    ventas.* ,
                                    usuario.nombre, usuario.apellido, usuario.celular, usuario.email
                                    FROM ventas 
                                    INNER JOIN usuario ON ventas.id_usuario = usuario.id
                                    WHERE ventas.id=" .$_GET['id_venta'])or die($conexion->error);

    $datosUsuarios =mysqli_fetch_row($datos);

    $datos2 = $conexion->query("SELECT *
                                    FROM ventas 
                                    WHERE id=" .$_GET['id_venta']);

    $datosVentas =mysqli_fetch_row($datos2);


    $datos3 = $conexion->query("SELECT
                                    productos_venta.*,
                                    productos.nombre
                                    FROM productos_venta
                                    INNER JOIN productos ON productos_venta.id_producto = productos.id
                                    WHERE id_venta =".$_GET['id_venta'])or die($conexion->error);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <!-- META -->
    <?php include('../layout/meta.php'); ?>

    <!-- TITULO -->
    <title>Ver pedido - Dew Rosas</title>

    <!-- ESTILOS -->
    <link rel="stylesheet" href="../css/ver_pedido.css">

    <!-- ICONOS -->
    <?php include('../layout/iconos.php'); ?>
</head>
<body>
    <!-- HEADER -->
    <?php include('../layout/header.php'); ?>

    <main>
        <h2>Pedido N° <?php echo $_GET['id_venta']; ?></h2>

        <fieldset>
            <legend>Comprador</legend>
            <div>
                <span>Nombre y apellido: </span> <span><?php echo $datosUsuarios['4'] ." ". $datosUsuarios['5']; ?></span>
            </div>

            <div>
                <span>Celular: </span><span><?php echo $datosUsuarios['6']; ?></span>
            </div>

            <div>
                <span>Email: </span> <span> <?php echo $datosUsuarios['7']; ?></span>
            </div>
        </fieldset>

        <fieldset>
            <legend>Pedido</legend>

            <table>
                <thead>
                    <tr>
                        <td>Nombre</td>
                        <td>Cant</td>
                        <td>Precio</td>
                    </tr>
                </thead>
                <tbody>
                    <?php
                        while($f = mysqli_fetch_array($datos3)){ ?>
                            <tr>
                                <td><?php echo $f['nombre']; ?></td>
                                <td><?php echo $f['cantidad']; ?></td>
                                <td>$ <?php echo number_format($f['precio'] , 0, ',', '.');?></td>
                            </tr>
                    <?php } ?>
                </tbody>
            </table>
        </fieldset>

        <p>La compra se realizo el día
            <?php echo date("d/m/Y H:i", strtotime($datosVentas['3'])); ?>
            y el total de la compra es de $<?php echo number_format($datosVentas['2'], 0, ',', '.');?>.</p>
    </main>



    
    <!-- FOOTER -->
    <?php include('../layout/footer.php'); ?>

    <!-- SCRIPT DEL MENU -->
    <script src="../js/menu.js"></script>
</body>
</html>