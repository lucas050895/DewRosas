<?php
    include('base/conexion.php');
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dew Rosas</title>

    <link rel="stylesheet" href="css/index.css">

    <!-- FONTAWESOME  -->
    <script src="https://kit.fontawesome.com/439ee37b3b.js" crossorigin="anonymous"></script>

    <!-- BOXICONS  -->
    <link href='https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css' rel='stylesheet'>

</head>
<body>

    <?php
        include('layout/header.php');
    ?>


    <main class="contenedor-index">
        <section id="destacados">
            <h2>
                <i class="fas fa-fire-alt"></i>
                <i class="fas fa-fire-alt"></i>
                Más vendidos
                <i class="fas fa-fire-alt"></i>
                <i class="fas fa-fire-alt"></i>
            </h2>
            <div id="cCarousel">
                <i class="fas fa-chevron-circle-left" id="prev" style="color:rgb(255, 255, 255);"></i>
                <i class="fas fa-chevron-circle-right" id="next" style="color: rgb(255, 255, 255);"></i>

                <div id="carousel-vp">
                    <div id="cCarousel-inner">
                        <?php
                            $resultado = $conexion ->query("SELECT * FROM productos WHERE destacado = 1")or die($conexion -> error);
                            while($fila =mysqli_fetch_array($resultado)){ ?>
                                <article class="cCarousel-item">
                                    <figure>
                                        <!-- AGREGAR IMAGEN A LA CARPETA "assets/img" Y CAMBIAR example.jpg <?php echo $fila['nombre']; ?> -->
                                        <img src="assets/img/example.jpg" alt="<?php echo $fila['nombre']; ?>">
                                    </figure>
                                    <div class="infos">
                                        <h3><?php echo $fila['nombre']; ?></h3>
                                        <span><?php echo $fila['precio']; ?></span>
                                        <button type="button">
                                            <a href="enlaces/producto.php?id=<?php echo $fila['id']; ?>">
                                                Ver
                                            </a> 
                                        </button>
                                    </div>
                                </article>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </section>
        
        <section id="catalogo">
            <h2>nuestro catalgoo</h2>

            <div>
                <span>Conjuntos</span>
                <span>Bodys</span>
                <span>Bombachas</span>
                <span>Bustier</span>
                <span>Corsets</span>
            </div>
        </section>
    </main>

    <?php
        include('layout/footer.php');
    ?>
    
    <script src="js/menu.js"></script>
    <script src="js/carrousel.js"></script>

</body>
</html>
