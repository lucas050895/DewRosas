<?php
  session_start();

  include("../config/conexion.php");

  if(!isset($_SESSION['login'])){
    header("Location: ../index");
  }

  $arregloUsuario = $_SESSION['login'];

  if($arregloUsuario['nivel']!= 'admin'){
    header("Location: ../index");
  }

  $resultado = $conexion->query("SELECT productos.*, categorias.nombre AS nombreCategoria
                                  FROM productos
                                  INNER JOIN categorias ON productos.id_categoria = categorias.id
                                  ORDER BY productos.id_categoria DESC")or die($conexion->error);
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Productos | Dashboard</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <?php include("layout/link.php");?>
  
</head>
<body class="hold-transition sidebar-mini sidebar-collapse">
<div class="wrapper">

<?php include("layout/header.php");?>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Productos</h1>
          </div><!-- /.col -->
          <div class="col-sm-6 text-right">
            <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
              Insertar producto
            </button>

          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <?php if(isset($_GET['error'])){ ?>
          
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
              <?php echo $_GET['error'];?>
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>

        <?php } ?>

        <?php if(isset($_GET['success'])){ ?>
          
            <div class="alert alert-success alert-dismissible fade show" role="alert">
              Se ha insertado correctamente.
              <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>

        <?php } ?>


        <table class="col-sm-12">
          <thead>
            <tr>
              <th>Id</th>
              <th>Img 1</th>
              <th>Nombre</th>
              <th>Descripción</th>
              <th>Inventario</th>
              <th>Categoria</th>
              <th>Talla</th>
              <th>Color</th>
              <th>Destacado</th>
              <th></th>
            </tr>
          </thead>
          <tbody>
            <?php
              while($row = mysqli_fetch_array($resultado)){?>
                <tr>
                  <td> <?php echo $row['id'] ?> </td>
                  <td> 
                    <img src="../assets/img/<?php echo $row['imagen1'] ?>" alt="<?php echo $row['nombre'] ?>" width="50px" height="50px">
                  </td>
                  <td> <?php echo $row['nombre'] ?> </td>
                  <td> <?php echo $row['descripcion'] ?> </td>
                  <td> <?php echo $row['inventario'] ?> </td>
                  <td> <?php echo $row['nombreCategoria'] ?> </td>
                  <td> <?php echo $row['talla'] ?> </td>
                  <td> <?php echo $row['color'] ?> </td>
                  <td>
                    <?php
                        if (empty($row['destacado'] != 1)) {
                            echo "Si";
                        }else{
                            echo "No";
                        }
                    ?>
                  </td>
                  
                  <td>
                      <button class="btn btn-primary btn-small btnEditar"  
                        data-id="<?php echo $row['id']; ?>"
                        data-nombre="<?php echo $row['nombre']; ?>"
                        data-descripcion="<?php echo $row['descripcion']; ?>"
                        data-inventario="<?php echo $row['inventario']; ?>"
                        data-categoria="<?php echo $row['id_categoria']; ?>"
                        data-talla="<?php echo $row['talla']; ?>"
                        data-color="<?php echo $row['color']; ?>"
                        data-precio="<?php echo $row['precio']; ?>"
                        data-destacado="<?php echo $row['destacado']; ?>"
                        data-toggle="modal" data-target="#modalEditar">
                        <i class="fa fa-edit"></i>
                      </button>
                      <button class="btn btn-danger btn-small btnEliminar" data-toggle="modal" data-target="#modalEliminar" data-id="<?php echo $row['id']; ?>">
                        <i class="fa fa-trash"></i>
                    </button>
                  </td>
                </tr>
                
              <?php } ?>
          </tbody>
        </table>
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>

    <!-- MODAL INSERTAR -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <form action="../php/insertar_producto.php" method="POST" enctype="multipart/form-data">
            <div class="modal-header">
              <h5 class="modal-title" id="exampleModalLabel">insertar producto</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">

              <div class="form-group">
                <label for="imagen1">Imagen</label>
                <input type="file" name="imagen1" id="imagen1" class="form-control" >
              </div>
              
              <div class="form-group">
                <label for="nombre">Nombre</label>
                <input type="text" name="nombre" id="nombre" placeholder="Nombre" class="form-control" >
              </div>
              
              <div class="form-group">
                <label for="descripcion">Descripción</label>
                <input type="text" name="descripcion" id="descripcion" placeholder="Descripción" class="form-control" >
              </div>
              
              <div class="form-group">
                <label for="precio">Precio</label>
                <input type="number" min="0" name="precio" id="precio" placeholder="Precio" class="form-control" >
              </div>

              <div class="form-group">
                <label for="inventario">Inventario</label>
                <input type="number" min="0" name="inventario" id="inventario" placeholder="Inventario" class="form-control" >
              </div>

              
              <div class="form-group">
                <label for="categoria">Categoria</label>
                <select name="categoria" id="categoria" >
                  <?php
                      $resultado = $conexion->query("SELECT * FROM categorias")or die($conexion->error);
                        ?><option value="" selected disabled>Seleccionar...</option><?php

                      while($row = mysqli_fetch_array($resultado)){?>

                        <option value="<?php echo $row['id'] ?>">
                          <?php echo $row['nombre'] ?>
                        </option>
                        
                      <?php } ?>
                </select>
              </div>

              <div class="form-group">
                <label for="talla">Talla</label>
                <input type="text" name="talla" id="talla" placeholder="Talla" class="form-control" >
              </div>

              <div class="form-group">
                <label for="color">Color</label>
                <input type="text" name="color" id="color" placeholder="Color" class="form-control" >
              </div>

              <div class="form-group">
                <label for="destacado">Destacado</label>
                  <select name="destacado" id="destacado" >
                    <option value="" selected disabled>Seleccionar...</option>
                    <option value="1">Si</option>
                    <option value="0">No</option>
                </select>
              </div>

            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            <button type="submit" class="btn btn-primary">Guardar</button>
          </form>
          </div>
        </div>
      </div>
    </div>

    <!-- MODAL ELIMINAR -->
    <div class="modal fade" id="modalEliminar" tabindex="-1" role="dialog" aria-labelledby="modalEliminarLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="modalEliminarLabel">Eliminar producto</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">
              ¿Desea eliminar el producto?
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            <button type="submit" class="btn btn-danger eliminar" data-dismiss="modal">Eliminar</button>
          </div>
        </div>
      </div>
    </div>

    <!-- MODAL EDITAR -->
    <div class="modal fade" id="modalEditar" tabindex="-1" role="dialog" aria-labelledby="modalEditar" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <form action="../php/editar_producto.php" method="POST" enctype="multipart/form-data">
            <div class="modal-header">
              <h5 class="modal-title" id="modalEditar">Editar producto</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <div class="modal-body">

              <input type="hidden" id="idEdit" name="id">

              <div class="form-group">
                <label for="imagenEdit">Imagen 1</label>
                <input type="file" name="imagen1" id="imagenEdit" class="form-control" >
              </div>
              
              <div class="form-group">
                <label for="imagen2">Imagen 2</label>
                <input type="file" name="imagen2" id="imagen2" class="form-control" >
              </div>

              <div class="form-group">
                <label for="imagen3">Imagen 3</label>
                <input type="file" name="imagen3" id="imagen3" class="form-control" >
              </div>
              
              <div class="form-group">
                <label for="nombreEdit">Nombre</label>
                <input type="text" name="nombre" id="nombreEdit" placeholder="Nombre" class="form-control" >
              </div>
              
              <div class="form-group">
                <label for="descripcionEdit">Descripción</label>
                <input type="text" name="descripcion" id="descripcionEdit" placeholder="Descripción" class="form-control" >
              </div>
              
              <div class="form-group">
                <label for="precioEdit">Precio</label>
                <input type="number" min="0" name="precio" id="precioEdit" placeholder="Precio" class="form-control" >
              </div>

              <div class="form-group">
                  <label for="inventarioEdit">Inventario</label>
                  <input type="number" min="0" name="inventario" placeholder="inventario" id="inventarioEdit" class="form-control" required>
              </div>

              
              <div class="form-group">
                <label for="categoriaEdit">Categoria</label>
                <select name="categoria" id="categoriaEdit" >
                  <?php
                      $resultado = $conexion->query("SELECT * FROM categorias")or die($conexion->error);
                        ?><option value="" selected disabled>Seleccionar...</option><?php

                      while($row = mysqli_fetch_array($resultado)){?>

                        <option value="<?php echo $row['id'] ?>">
                          <?php echo $row['nombre'] ?>
                        </option>
                        
                      <?php } ?>
                </select>
              </div>

              <div class="form-group">
                <label for="tallaEdit">Talla</label>
                <input type="text" name="talla" id="tallaEdit" placeholder="Talla" class="form-control" >
              </div>

              <div class="form-group">
                <label for="colorEdit">Color</label>
                <input type="text" name="color" id="colorEdit" placeholder="Color" class="form-control" >
              </div>

              <div class="form-group">
                <label for="destacadoEdit">Destacado</label>
                  <select name="destacado" id="destacadoEdit" >
                    <option value="" selected disabled id="destacadoEdit">Seleccionar...</option>
                    <option value="1">Si</option>
                    <option value="0">No</option>
                </select>
              </div>

            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cerrar</button>
            <button type="submit" class="btn btn-primary editar">Guardar</button>
          </form>
          </div>
        </div>
      </div>
    </div>

  <?php include("layout/footer.php")?>
</div>


<?php include("layout/script.php")?>

<script>
  $(document).ready(function(){
    var idEliminar = -1;
    var idEditar = -1;
    var fila;
    $(".btnEliminar").click(function(){
      idEliminar = $(this).data('id');
      fila= $(this).parent('td').parent('tr');
    });
    $(".eliminar").click(function(){
      $.ajax({
        url: '../php/eliminar_producto.php',
        method: 'POST',
        data:{
          id:idEliminar
        }
      }).done(function(res){
          $(fila).fadeOut(1000);
        })
    });

    $(".btnEditar").click(function(){
      idEditar=$(this).data('id');
      var nombre=$(this).data('nombre');
      var descripcion=$(this).data('descripcion');
      var inventario=$(this).data('inventario');
      var categoria=$(this).data('categoria');
      var talla=$(this).data('talla');
      var color=$(this).data('color');
      var precio=$(this).data('precio');
      var destacado=$(this).data('destacado');
      $("#nombreEdit").val(nombre);
      $("#descripcionEdit").val(descripcion);
      $("#inventarioEdit").val(inventario);
      $("#categoriaEdit").val(categoria);
      $("#tallaEdit").val(talla);
      $("#colorEdit").val(color);
      $("#precioEdit").val(precio);
      $("#destacadoEdit").val(destacado);
      $("#idEdit").val(idEditar);
    });
  });
</script>

</body>
</html>
