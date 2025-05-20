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
    <!-- META -->
    <?php include('../layout/meta.php'); ?>

    <!-- TITULO -->
    <title>Realizar Pedido - Dew Rosas</title>

    <!-- ESTILOS -->
    <link rel="stylesheet" href="../css/realizar_pedido.css">

    <!-- ICONOS -->
    <?php include('../layout/iconos.php'); ?>
</head>
<body>
    <?php
        include('../layout/header.php');
    ?>

    <main>
        <form action="../php/insertar_pedido.php" method="POST">
            <fieldset>
                <legend>Crear cuenta</legend>
                <div>
                    <label for="nombre">Nombre</label>
                    <input type="text" id="nombre" name="nombre" required>
                </div>

                <div>
                    <label for="apellido">Apellido</label>
                    <input type="text" id="apellido" name="apellido" required>
                </div>

                <div>
                    <label for="celular">Celular</label>
                    <input type="number" id="celular" name="celular" required>
                </div>

                <div>
                    <label for="direccion">Dirección</label>
                    <input type="text" id="direccion" name="direccion" required>
                </div>

                <div>
                    <label for="localidad">Localidad</label>
                    <input type="text" id="localidad" name="localidad" required>
                </div>

                <div>
                    <label for="email">E-mail</label>
                    <input type="email" id="email" name="email" required>
                </div>

                <div>
                    <label for="contraseña">Contraseña</label>
                    <input type="password" id="contraseña" name="contraseña" required>
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

    <!-- SCRIPT DEL MENU -->
    <script src="../js/menu.js"></script>
</body>
</html>