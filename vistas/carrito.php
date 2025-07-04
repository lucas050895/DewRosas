<?php
    session_start();

    include('../config/conexion.php');

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
                header("Location: carrito.php");
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
                header("Location: carrito.php");
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
            header("Location: carrito.php");
        }
    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <!-- META -->
    <?php include('../layout/meta.php'); ?>

    <!-- CSS -->
    <link rel="stylesheet" href="../assets/css/carrito.css">

    <!-- ICONOS -->
    <?php include('../layout/iconos.php'); ?>
</head>
<body>
    <!-- HEADER -->
    <?php include('../layout/header.php');?>  
      
    <!-- CONTENIDO -->
    <main class="contenedor">
        <table>
            <thead>
                <tr>
                    <td>Nombre</td>
                    <td>Cant</td>
                    <td>Precio</td>
                    <td>Borrar</td>
                </tr>
            </thead>

            <tbody>
                <?php 
                    $total = 0;

                    if(isset($_SESSION['carrito'])){
                        $arregloCarrito = $_SESSION['carrito'];
                        for($i=0;$i<count($arregloCarrito);$i++){
                            $total = $total + ($arregloCarrito[$i]['Precio'] * $arregloCarrito[$i]['Cantidad']);
                ?>
                    <tr>
                        <td>
                            <?php echo substr($arregloCarrito[$i]['Nombre'], 0, 12) ;?>
                        </td>

                        <td>
                            <?php echo $arregloCarrito[$i]['Cantidad']; ?>
                        </td>

                        <td>
                            $ <?php echo $precio_formateado = number_format($arregloCarrito[$i]['Precio'], 0, ',', '.');?>
                        </td>

                        <td>
                            <a href="#" class="btnEliminar" data-id="<?php echo $arregloCarrito[$i]['Id']; ?>">
                                <i class="fas fa-times"></i>
                            </a>
                        </td>
                    </tr>
                <?php
                        }
                    }
                ?>
            </tbody>
        </table>
    </main>

    <table class="total">
        <thead>
            <tr>
                <td colspan="3">Total</td>
                <td colspan="1">
                    $ <?php echo $total_formateado = number_format($total, 0, ',', '.');?>
                </td>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td colspan="4">
                    <a href="realizar_pedido" class="realizarPedido">
                        <button>
                            Checkout
                        </button>
                    </a>
                </td>
            </tr>
        </tbody>
    </table>

    <!-- FOOTER -->
    <?php include('../layout/footer.php');?> 
    
    <script src="../assets/js/menu.js"></script>
    <script src="../assets/js/jquery-3.7.1.js"></script>

    <script>
        $(document).ready(function(){
            $(".btnEliminar").click(function(event){
                event.preventDefault();
                var id = $(this).data('id');
                var boton = $(this);

                $.ajax({
                    type: "POST",
                    url: "../php/eliminarCarrito.php",
                    data: {
                        id: id
                    }
                }).done(function(respuesta){
                    boton.parent('td').parent('tr').remove();
                });

            });
        });
    </script>

    <!-- SCRIPT DEL MENU -->
    <script src="../assets/js/menu.js"></script>
</body>
</html>