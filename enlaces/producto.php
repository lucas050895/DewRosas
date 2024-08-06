<?php
    include('../base/conexion.php');
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title></title>
    <link rel="stylesheet" href="../css/producto.css">
    <link rel="stylesheet" href="../css/general.css">
    <link rel="stylesheet" href="../iconos/style.css">
</head>
<body>
    <?php
        include('../layout/header.php');
    ?>

    <main class="contenedor">
        <?php
            if(isset($_GET['id'])){
                $resultado = $conexion -> query ("SELECT * FROM productos WHERE id=" . $_GET['id'])or die($conexion -> error);
                if(mysqli_num_rows($resultado) > 0){
                    $fila = mysqli_fetch_row($resultado);
                }else{
                    header("Location: ../index.php");
                }
            }else{
                header("Location: ../index.php");
            }
        ?>
        
        
        <h2><?php echo $fila[1]?></h2>

        <div class="carrousel">
            <div class="grande">
                <img src="../Img/<?php echo $fila[4] ?>" alt="<?php echo $fila[1] ?>">
                <img src="../Img/<?php echo $fila[9] ?>" alt="<?php echo $fila[1] ?>">
                <img src="../Img/<?php echo $fila[10] ?>" alt="<?php echo $fila[1] ?>">
                <img src="../Img/<?php echo $fila[11] ?>" alt="<?php echo $fila[1] ?>">
                <img src="../Img/<?php echo $fila[12] ?>" alt="<?php echo $fila[1] ?>">
            </div>
        </div>

        <div class="puntos">
            <div class="punto activo"></div>
            <div class="punto"></div>
            <div class="punto"></div>
            <div class="punto"></div>
            <div class="punto"></div>
        </div>

        <section>
            <p>
                <span>
                    Descripción:
                </span>
                <br>
                <span>
                    <?php echo $fila[2]?>
                </span>
            </p>
            <p>
                <span>
                    Talla:
                </span>
                <br>
                <span>
                    <?php echo $fila[7]?>
                </span>
            </p>
            <h3>$<?php echo $fila[3]?></h3>
        </section> 

        <div class="botones">
            <button type="button">
                <a href="carrito.php?id=<?php echo $fila[0]; ?>">agregar</a>
            </button>
            <label for="Cantidad"></label>
            <input type="number" name="Cantidad" id="" value="1" min="1">
        </div>
    </main>

    <?php
        include('../layout/creado.php');
    ?>

    <script src="../js/menu.js"></script>
    <script src="../js/carrousel.js"></script>
</body>
</html>