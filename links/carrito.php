<?php
    session_start();

    include('../conexion/conexion.php');

    if(isset($_SESSION['carrito'])){
        // Si exite buscamos si ya estaba agregado ese producto
        if(isset($_GET['id'])){
            $arreglo = $_SESSION['carrito'];
            $encontro = false;
            $numero = 0;

            for($i=0;$i<count($arreglo);$i++){
                if($arreglo[$i]['Id'] == $_GET['id']){
                    $encontro = true;
                    $numero = $i;
                }
            }

            if($encontro == true){
                // Si ya existe, solo aumentamos la cantidad
                $arreglo[$numero]['Cantidad'] = $arreglo[$numero]['Cantidad'] + 1;
                $_SESSION['carrito']=$arreglo;
            }else{
                // Si no existe, lo agregamos al carrito
                $nombre = "";
                $precio = "";
                $res = $conexion->query('SELECT * FROM productos WHERE id='.$_GET['id']) or die($conexion->error);

                $fila = mysqli_fetch_row($res);
                $nombre = $fila[1];
                $precio = $fila[3];

                $arregloNuevo = array(
                    'Id'=> $_GET['id'],
                    'Nombre'=> $nombre,
                    'Precio'=> $precio,
                    'Cantidad' => 1
                );

                array_push($arreglo, $arregloNuevo);
                $_SESSION['carrito']=$arreglo;
            }
        }
    }else{
        // Si no exite, creamos la variable de sesion
        if(isset($_GET['id'])){
            $nombre = "";
            $precio = "";

            $res = $conexion->query('SELECT * FROM productos WHERE id='.$_GET['id']) or die($conexion->error);

            $fila = mysqli_fetch_row($res);
            $nombre = $fila[1];
            $precio = $fila[3];

            $arreglo[] = array(
                'Id'=> $_GET['id'],
                'Nombre'=> $nombre,
                'Precio'=> $precio,
                'Cantidad' => 1
            );
            $_SESSION['carrito']=$arreglo;
        }
    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <?php
        include('../layout/meta.php');
    ?>

    <title>Carrito de Compras</title>

    <link rel="stylesheet" href="../css/carrito.css">

    <!-- FONTAWESOME  -->
    <script src="https://kit.fontawesome.com/439ee37b3b.js" crossorigin="anonymous"></script>
    <!-- BOXICONS  -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

</head>
<body>
    <?php
        include('../layout/header.php');
    ?>  
      
    <main class="contenedor">
        <table>
            <thead>
                <tr>
                    <td>Nombre</td>
                    <td>Precio</td>
                    <td>Cant</td>
                    <td>Borrar</td>
                </tr>
            </thead>

            <?php 
                if(isset($_SESSION['carrito'])){
                    $arregloCarrito = $_SESSION['carrito'];
                    for($i=0;$i<count($arregloCarrito);$i++){
            ?>
                    <tr>
                        <td>
                            <?php echo $arregloCarrito[$i]['Nombre'];?>
                        </td>
                        <td>
                            $ <?php echo $precio_formateado = number_format($arregloCarrito[$i]['Precio'], 0, ',', '.');?>
                        </td>
                        <td>
                            <?php echo $arregloCarrito[$i]['Cantidad'];?>
                        </td>
                        <td>
                            <a href="eliminar.php?id=<?php echo $i;?>">
                                <i class="fas fa-times"></i>
                            </a>
                        </td>
                    </tr>

            <?php
                    }
                }
            ?>
        </table>
    </main>

    <?php
        include('../layout/footer.php');
    ?> 
    
    <script src="../js/menu.js"></script>
</body>
</html>