<?php
    session_start();

    include('../base/conexion.php');

    if(isset($_SESSION['carrito'])){
        // Si exite buscamos si ya estaba agregado ese producto
    }else{
        // Si no exite, creamos la variable de sesion
        if(isset($_GET['id'])){
            $nombre = "";
            $precio = "";
            $imagen = "";

            $res = $conexion->query('SELECT * FROM productos WHERE id='.$_GET['id']) or die($conexion->error);

            $fila = mysqli_fetch_row($res);
            $nombre = $fila[1];
            $precio = $fila[3];
            $imagen = $fila[4];

            $arreglo[] = array(
                'Id'=> $_GET['id'],
                'Nombre'=> $nombre,
                'Precio'=> $precio,
                'Imagen'=> $imagen,
                'Cantidad' => 1
            );
            $_SESSION['carrito']=$arreglo;
        }
    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito de Compras</title>
    <link rel="stylesheet" href="../css/general.css">
    <link rel="stylesheet" href="../css/menu.css">
    <link rel="stylesheet" href="../css/carrito.css">
    <link rel="stylesheet" href="../iconos/style.css">

</head>
<body>
    <?php
        include('../layout/header.php');
    ?>    
    <main class="contenedor">
        <?php 
            if(isset($_SESSION['carrito'])){
                $arregloCarrito = $_SESSION['carrito'];
                for($i=0;$i<count($arregloCarrito);$i++){


        ?>
                <div>
                    <div>
                        <img src="../Img/<?php  $arregloCarrito[$i]['Imagen'] ?>" alt="">
                    </div>
                    <div>
                        <p>
                            <?php $arregloCarrito[$i]['Nombre'];?>
                        </p>
                    </div>
                    <div></div>
                    <div></div>
                    <div></div>
                    <div></div>
                </div>

        <?php
                }
            }
        ?>
    </main>
    
    <script src="../js/menu.js"></script>
</body>
</html>