<?php
    include('../conexion/conexion.php');
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <?php
        include('../layout/meta.php');
    ?>

    <title>Dew Rosas</title>
    <link rel="stylesheet" href="../css/producto.css">

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
        
    

        <div class="contenedor-img">
			<div class="imagen actual">
				<img src="../assets/Img/example.jpg" />
			</div>
			
			<div class="imagen">
				<img src="../assets/Img/example.jpg" />
			</div>
			
			<div class="imagen">
				<img src="../assets/Img/example.jpg" />
			</div>
			
			<div class="imagen">
				<img src="../assets/Img/example.jpg" />
			</div>
			
			<a href="#" class="anterior" onclick="anterior();">&#10094;</a>
			<a href="#" class="siguiente" onclick="siguiente();">&#10095;</a>
			
			<div class="puntos">
				<span class="punto activo" onclick="mostrar(0);"></span>
				<span class="punto" onclick="mostrar(1);"></span>
				<span class="punto" onclick="mostrar(2);"></span>
				<span class="punto" onclick="mostrar(3);"></span>
			</div>
			
		</div>

        <section>
            <div class="descripcion">
                <h2><?php echo $fila[1]; ?></h2>

                <p><?php echo $fila[2]; ?></p>

                <p>Talla: <?php echo $fila[11]; ?></p>

                <p>Color: <?php echo $fila[12]; ?></p>

                <p class="precio">Precio: $
                    <?php echo $precio_formateado = number_format($fila[3], 0, ',', '.');?>
                </p>

                <a href="carrito.php?id=<?php echo $fila[0]; ?>" class="btn">
                    <button>Agregar al carrito</button>
                </a>
            </div>
        </section>

    </main>

    <?php
        include('../layout/footer.php');
    ?>

    <script src="../js/menu.js"></script>
    <script src="../js/carrousel.js"></script>
    <script>
        var actual = 0;
			function puntos(n){
				var ptn = document.getElementsByClassName("punto");
				for(i = 0; i<ptn.length; i++){
					if(ptn[i].className.includes("activo")){
						ptn[i].className = ptn[i].className.replace("activo", "");
						break;
					}
				}
				ptn[n].className += " activo";
			}
			function mostrar(n){
				var imagenes = document.getElementsByClassName("imagen");
				for(i = 0; i< imagenes.length; i++){
					if(imagenes[i].className.includes("actual")){
						imagenes[i].className = imagenes[i].className.replace("actual", "");
						break;
					}
				}
				actual = n;
				imagenes[n].className += " actual";
				puntos(n);
			}
			
			function siguiente(){
				actual++;
				if(actual > 3){
					actual = 0;
				}
				mostrar(actual);
			}
			function anterior(){
				actual--;
				if(actual < 0){
					actual = 3;
				}
				mostrar(actual);
			}
			
			var velocidad = 8000;
			var play = setInterval("siguiente()", velocidad);
			
    </script>
</body>
</html>