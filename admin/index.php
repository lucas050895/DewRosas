<?php
  session_start();

  if(!isset($_SESSION['login'])){
    header("Location: ../index");
  }

  $arregloUsuario = $_SESSION['login'];
?>
<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Inicio | Dashboard</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <?php include("layout/link.php");?>

</head>
<body class="hold-transition sidebar-mini sidebar-collapse">

  <div class="wrapper">

    <?php include("layout/header.php"); ?>

    <div class="content-wrapper">
      
      <div class="content-header">
        <div class="container-fluid">
          <div class="row mb-4">
            <div class="col-sm-12">
              <h1 class="m-0 text-dark">Dashboard</h1>
            </div>
          </div>
        </div>
      </div>

      <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-lg-3 col-6">
              <div class="small-box bg-info">
                <div class="inner">
                  <h3>150</h3>
                  <p>Pedidos</p>
                </div>
              </div>
            </div>

            <div class="col-lg-3 col-6">
              <div class="small-box bg-success">
                <div class="inner">
                  <h3>53<sup style="font-size: 20px">%</sup></h3>
                  <p>Porcentaje</p>
                </div>
              </div>
            </div>

            <div class="col-lg-3 col-6">
              <div class="small-box bg-warning">
                <div class="inner">
                  <h3>44</h3>

                  <p>Clientes</p>
                </div>
              </div>
            </div>
          </div>


        </div>
      </section>
    </div>

    <?php include("layout/footer.php")?>
  </div>

<?php include("layout/script.php")?>
</body>
</html>
