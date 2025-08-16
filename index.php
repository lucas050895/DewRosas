<?php
    include 'config/conexion.php';

    session_start();
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <!-- META  -->
    <?php include 'layout/meta.php' ; ?>

    <!-- CSS -->
    <link rel="stylesheet" href="assets/css/index.css">

    <!-- ICONOS  -->
    <?php include 'layout/iconos.php'; ?>
</head>
<body>
    <?php
        include 'layout/header.php';
    ?>

    <main class="contenedor-index">
        <section id="destacados">
            <h2 class="titulo">
                <i class="fas fa-fire-alt"></i>
                <i class="fas fa-fire-alt"></i>
                Más vendidos
                <i class="fas fa-fire-alt"></i>
                <i class="fas fa-fire-alt"></i>
            </h2>
            <div id="cCarousel">
                <i class="fas fa-chevron-circle-left" id="prev" style="color:rgb(0, 0, 0);"></i>
                <i class="fas fa-chevron-circle-right" id="next" style="color: rgb(0, 0, 0);"></i>

                <div id="carousel-vp">
                    <div id="cCarousel-inner">
                        <?php
                            $resultado = $conexion ->query("SELECT * FROM productos WHERE destacado = 1 AND inventario > 0 ")or die($conexion -> error);
                            while($fila =mysqli_fetch_array($resultado)){ ?>
                                <article class="cCarousel-item">
                                    <a href="http://lucasconde.ddns.net/DewRosas/vistas/producto?id=<?php echo $fila['id']; ?>">
                                        <figure>
                                            <img src="assets/img/<?php echo $fila['imagen1'];?>" alt="">
                                        </figure>

                                        <span>
                                            <?php echo $fila['nombre']; ?>
                                        </span>

                                        <span>
                                            <?php
                                                echo $precio_formateado = number_format($fila['precio'], 0, ',', '.');
                                            ?>
                                        </span>
                                        
                                    </a> 
                                </article>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </section>
    
        <section id="catalogo">
            <h2 class="titulo">
                Nuestro Catálogo
                <i class="fas fa-sort-down"></i>
            </h2>

            <div class="warpper">

                <input class="radio" id="one" name="group" type="radio" checked>
                <input class="radio" id="two" name="group" type="radio">
                <input class="radio" id="three" name="group" type="radio">


                <div class="tabs">
                    <label class="tab" id="one-tab" for="one">Conjuntos</label>
                    <label class="tab" id="two-tab" for="two">Bombachas</label>
                    <label class="tab" id="three-tab" for="three">Corpiños</label>
                </div>

                <div class="panels">
                    <div class="panel" id="one-panel">
                        <div>
                            <?php
                                $resultado = $conexion ->query("SELECT *
                                                                    FROM productos
                                                                    WHERE id_categoria = 1 AND inventario > 0
                                                                    LIMIT 10")or die($conexion -> error);
                                while($fila =mysqli_fetch_array($resultado)){ ?>
                                    <article>
                                        <a href="http://lucasconde.ddns.net/DewRosas/vistas/producto?id=<?php echo $fila['id']; ?>">
                                            <span>
                                                <?php echo $fila['nombre']; ?>
                                            </span>
                                            <figure>
                                                <img src="assets/img/<?php echo $fila['imagen1'];?>" alt="<?php echo $fila['nombre']; ?>">
                                            </figure>

                                            <span>
                                                <?php
                                                    echo $precio_formateado = number_format($fila['precio'], 0, ',', '.');
                                                ?>
                                            </span>
                                        </a> 
                                    </article>
                            <?php } ?>
                        </div>
                        <a href="http://lucasconde.ddns.net/DewRosas/vistas/categoria?id_categoria=1">Ver todos</a>
                    </div>

                    <div class="panel" id="two-panel">
                        <div>
                            <?php
                                $resultado = $conexion ->query("SELECT *
                                                                    FROM productos
                                                                    WHERE id_categoria = 2 AND inventario > 0
                                                                    LIMIT 10")or die($conexion -> error);
                                while($fila =mysqli_fetch_array($resultado)){ ?>
                                    <article>
                                        <a href="http://lucasconde.ddns.net/DewRosas/vistas/producto?id=<?php echo $fila['id']; ?>">
                                            <span>
                                                <?php echo $fila['nombre']; ?>
                                            </span>
                                            <figure>
                                                <img src="assets/img/<?php echo $fila['imagen1'];?>" alt="<?php echo $fila['nombre']; ?>">
                                            </figure>

                                            <span>
                                                <?php
                                                    echo $precio_formateado = number_format($fila['precio'], 0, ',', '.');
                                                ?>
                                            </span>
                                        </a> 
                                    </article>
                            <?php } ?>
                        </div>
                        <a href="http://lucasconde.ddns.net/DewRosas/vistas/categoria?id_categoria=2">Ver todos</a>
                    </div>

                    <div class="panel" id="three-panel">
                        <div>
                            <?php
                                $resultado = $conexion ->query("SELECT *
                                                                    FROM productos
                                                                    WHERE id_categoria = 3 AND inventario > 0
                                                                    LIMIT 10")or die($conexion -> error);
                                while($fila =mysqli_fetch_array($resultado)){ ?>
                                    <article>
                                        <a href="http://lucasconde.ddns.net/DewRosas/vistas/producto?id=<?php echo $fila['id']; ?>">
                                            <span>
                                                <?php echo $fila['nombre']; ?>
                                            </span>
                                            <figure>
                                                <img src="assets/img/<?php echo $fila['imagen1'];?>" alt="<?php echo $fila['nombre']; ?>">
                                            </figure>

                                            <span>
                                                <?php
                                                    echo $precio_formateado = number_format($fila['precio'], 0, ',', '.');
                                                ?>
                                            </span>
                                        </a> 
                                    </article>
                            <?php } ?>
                        </div>
                        <a href="http://lucasconde.ddns.net/DewRosas/vistas/categoria?id_categoria=3">Ver todos</a>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <?php
        include 'layout/footer.php' ;
    ?>
    
    <script src="assets/js/menu.js"></script>
    <script src="assets/js/carrousel.js"></script>

</body>
</html>
