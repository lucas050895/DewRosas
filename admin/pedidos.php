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

  $resultado = $conexion->query("SELECT ventas.*, usuario.*
                                  FROM ventas
                                  INNER JOIN usuario ON ventas.id_usuario = usuario.id")or die($conexion->error);
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Pedidos | Dashboard</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <?php include("layout/link.php");?>
  
</head>
<body class="hold-transition sidebar-mini sidebar-collapse">
<div class="wrapper">

<?php include("layout/header.php");?>

  <div class="content-wrapper">
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0 text-dark">Pedidos</h1>
          </div>
        </div>
      </div>
    </div>

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

        <div id="accordion">
          <?php
            while($row = mysqli_fetch_array($resultado)){?>

                <div class="card">
                  <div class="card-header" id="heading<?php echo  $row['id']?>">
                    <h5 class="mb-0">
                      <button class="btn btn-link" data-toggle="collapse" data-target="#collapse<?php echo  $row['id']?>" aria-expanded="true" aria-controls="collapseOne">
                        <?php echo  $row['fecha'] . " - " .  $row['status']?>
                      </button>
                    </h5>
                  </div>

                  <div id="collapse<?php echo  $row['id']?>" class="collapse" aria-labelledby="heading<?php echo  $row['id']?>" data-parent="#accordion">
                    <div class="card-body">
                      <p class="h6">Datos del cliente</p>
                      <p>Nombre cliente: <?php echo  $row['nombre']?></p>
                      <p>Email: <?php echo  $row['email']?></p>
                      <p>Celular: <?php echo  $row['celular']?></p>
                      <p>Status: <?php echo  $row['status']?></p>
                      <p class="h6">Datos del envio</p>
                      <p>Dirección: <?php echo  $row['direccion']?></p>
                      <p>Localidad: <?php echo  $row['localidad']?></p>



                      <table class="col-sm-12">
                            <thead>
                              <tr>
                                <th>Nombre</th>
                                <th>Precio</th>
                                <th>Talla</th>
                                <th>Color</th>
                                <th>Cantidad</th>
                                <th>Subtotal</th>
                              </tr>
                            </thead>
                            <tbody>
                              <?php
                              $re= $conexion->query("SELECT productos_venta.*, 
                                                              productos.*
                                                              FROM productos_venta
                                                              INNER JOIN productos ON productos_venta.id_producto = productos.id
                                                              WHERE productos_venta.id_producto = productos.id")or die($conexion->error);
                                while($filafila = mysqli_fetch_array($re)){?>
                                  <tr>
                                    <td> <?php echo $filafila['nombre'] ?> </td>
                                    <td> $ <?php echo number_format( $filafila['precio'] ,2,',','') ?></td>
                                    <td> <?php echo $filafila['talla'] ?> </td>
                                    <td> <?php echo $filafila['color'] ?> </td>
                                    <td> <?php echo $filafila['cantidad'] ?> </td>
                                    <td> <?php echo $filafila['subtotal'] ?> </td>
                                  </tr>
                                  
                                <?php } ?>
                            </tbody>
                      </table>
                  </div>
                  </div>
                </div>

            <?php }
          ?>
        </div>

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
                <label for="imagen">Imagen</label>
                <input type="file" name="imagen" id="imagen" class="form-control" >
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
                <label for="imagenEdit">Imagen</label>
                <input type="file" name="imagen" id="imagenEdit" class="form-control" >
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
