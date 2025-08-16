<?php
    include('../config/conexion.php');

    
    if(isset($_GET['id_categoria'])){
        $resultado = $conexion -> query ("SELECT *
                                            FROM productos
                                            WHERE id_categoria = " . $_GET['id_categoria'])or die($conexion -> error);
        if(mysqli_num_rows($resultado) > 0){
            $fila = mysqli_fetch_row($resultado);
        }else{
            header("Location: ../index");
        }

?>
<!DOCTYPE html>
<html lang="en">
<head>
	<!-- META -->
    <?php include('../layout/meta.php');?>

	<!-- CSS -->
    <link rel="stylesheet" href="../assets/css/categoria.css">

    <!-- ICONOS -->
    <?php include('../layout/iconos.php'); ?>
</head>
<body>
    <!-- HEADER -->
    <?php include('../layout/header.php');?>

    <main>
        <?php
            while($fila = mysqli_fetch_array($resultado)){ ?>
                <article>
                    <a href="http://lucasconde.ddns.net/DewRosas/vistas/producto?id=<?php echo $fila['id']; ?>">
                        <span>
                            <?php echo $fila['nombre']; ?>
                        </span>
                        <figure>
                            <img src="../assets/img/<?php echo $fila['imagen1'];?>" alt="<?php echo $fila['nombre']; ?>">
                        </figure>

                        <span>
                            <?php
                                echo $precio_formateado = number_format($fila['precio'], 0, ',', '.');
                            ?>
                        </span>
                    </a> 
                </article>
        <?php } ?>
    </main>

    <!-- FOOTER -->
    <?php include('../layout/footer.php');?>

    <script src="../assets/js/menu.js"></script>
</body>
</html>

<?php
    }else{
        header("Location: ../index");
    }
?>


