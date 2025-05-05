<?php
    include('../conexion/conexion.php');

    session_start();

    if(!isset($_SESSION['carrito'])){
        header('Location: ../index.php');
    }

    $arreglo = $_SESSION['carrito']


?>
<!DOCTYPE html>
<html lang="es">
<head>
    <?php
        include('../layout/meta.php');
    ?>

    <title>Realizar Pedido - Dew Rosas</title>

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
        <form action="../php/subir_cliente.php" method="POST">
            <fieldset>
                <legend>Tus datos</legend>
                <div>
                    <label for="nombre">Nombre</label>
                    <input type="text" id="nombre" name="nombre" required>
                </div>

                <div>
                    <label for="apellido">Apellido</label>
                    <input type="text" id="apellido" name="apellido">
                </div>

                <div>
                    <label for="celular">Celular</label>
                    <input type="text" id="celular" name="celular">
                </div>

                <div>
                    <label for="email">E-mail</label>
                    <input type="text" id="email" name="email">
                </div>

                <div>
                    <label for="direccion">Dirección</label>
                    <input type="text" id="direccion" name="direccion">
                </div>

                <div>
                    <label for="localidad">Localidad</label>
                    <input type="text" id="localidad" name="localidad">
                </div>

            </fieldset>

                <div>
                    <h2>Tu pedido</h2>
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
                                $total = 0;
                                    for($i=0;$i<count($arreglo);$i++){
                                        $total = $total + ($arreglo[$i]['Precio']*$arreglo[$i]['Cantidad']);?>

                                        <tr>
                                            <td><?php echo $arreglo[$i]['Nombre']?></td>
                                            <td><?php echo $arreglo[$i]['Cantidad']?></td>
                                            <td>$ <?php echo $precio_formateado = number_format($arreglo[$i]['Precio'], 0, ',', '.')?></td>
                                        </tr>        
                            <?php } ?>
                        </tbody>
                    </table>

                    <span>Total: $ <?php echo $precio_formateado = number_format($total, 0, ',', '.')?></span>

                </div>

            <input type="submit" name="submit" value="Enviar">
        </form>
    </main>

    <?php
        include('../layout/footer.php');
    ?>
    
</body>
</html>