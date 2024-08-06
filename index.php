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
    <link rel="stylesheet" href="css/general.css">

    <link rel="stylesheet" href="iconos/style.css">
    <script src="https://kit.fontawesome.com/439ee37b3b.js" crossorigin="anonymous"></script>
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
                <i class="fas fa-chevron-circle-left" id="prev" style="color: #000000;"></i>
                <i class="fas fa-chevron-circle-right" id="next" style="color: #000000;"></i>

                <div id="carousel-vp">
                    <div id="cCarousel-inner">
                        <?php
                            $resultado = $conexion ->query("SELECT * FROM productos WHERE destacado = 1")or die($conexion -> error);
                            while($fila =mysqli_fetch_array($resultado)){ ?>
                                <article class="cCarousel-item">
                                    <figure>
                                        <img src="assets/img/<?php echo $fila['imagen'];?>_a.jpg" alt="<?php echo $fila['nombre']; ?>">
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
                <input type="radio" id="tab1" name="tab-control" checked>
                <input type="radio" id="tab2" name="tab-control">
                <input type="radio" id="tab3" name="tab-control">
                <input type="radio" id="tab4" name="tab-control">
                <input type="radio" id="tab5" name="tab-control">
                <input type="radio" id="tab6" name="tab-control">
                <input type="radio" id="tab7" name="tab-control">
                <input type="radio" id="tab8" name="tab-control">

                <ul>
                    <li title="Tab 1">
                        <label for="tab1" role="button">
                            <span>Conjuntos</span>
                        </label>
                    </li>

                    <li title="Tab 2">
                        <label for="tab2" role="button">
                            <span>Bodys</span>
                        </label>
                    </li>

                    <li title="Tab 3">
                        <label for="tab3" role="button">
                            <span>Bombachas</span>
                        </label>
                    </li>

                    <li title="Tab 4">
                        <label for="tab4" role="button">
                            <span>Bustier</span>
                        </label>
                    </li>

                    <li title="Tab 5">
                        <label for="tab5" role="button">
                            <span>Corsets</span>
                        </label>
                    </li>
                </ul>

                <div>
                    <section>
                        <?php
                            $resultado = $conexion ->query("SELECT * FROM productos WHERE id_categoria = 1")or die($conexion -> error);
                            while($fila =mysqli_fetch_array($resultado)){ ?>
                                <article>
                                    <figure>
                                        <img src="assets/img/<?php echo $fila['imagen'];?>_a.jpg" alt="<?php echo $fila['nombre']; ?>">
                                    </figure>
                                    <div>
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
                    </section>

                    <section>
                    <?php
                            $resultado = $conexion ->query("SELECT * FROM productos WHERE id_categoria = 2")or die($conexion -> error);
                            while($fila =mysqli_fetch_array($resultado)){ ?>
                                <article>
                                    <figure>
                                        <img src="assets/img/<?php echo $fila['imagen'];?>_a.jpg" alt="<?php echo $fila['nombre']; ?>">
                                    </figure>
                                    <div>
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
                    </section>

                    <section>
                        <?php
                            $resultado = $conexion ->query("SELECT * FROM productos WHERE id_categoria = 3")or die($conexion -> error);
                            while($fila =mysqli_fetch_array($resultado)){ ?>
                                <article>
                                    <figure>
                                        <img src="assets/img/<?php echo $fila['imagen'];?>_a.jpg" alt="<?php echo $fila['nombre']; ?>">
                                    </figure>
                                    <div>
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
                    </section>

                    <section>
                        <?php
                            $resultado = $conexion ->query("SELECT * FROM productos WHERE id_categoria = 4")or die($conexion -> error);
                            while($fila =mysqli_fetch_array($resultado)){ ?>
                                <article>
                                    <figure>
                                        <img src="assets/img/<?php echo $fila['imagen'];?>_a.jpg" alt="<?php echo $fila['nombre']; ?>">
                                    </figure>
                                    <div>
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
                    </section>

                    <section>
                        <?php
                            $resultado = $conexion ->query("SELECT * FROM productos WHERE id_categoria = 5")or die($conexion -> error);
                            while($fila =mysqli_fetch_array($resultado)){ ?>
                                <article>
                                    <figure>
                                        <img src="assets/img/<?php echo $fila['imagen'];?>_a.jpg" alt="<?php echo $fila['nombre']; ?>">
                                    </figure>
                                    <div>
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
                    </section>
                </div>
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
