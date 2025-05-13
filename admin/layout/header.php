  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <!-- <li class="nav-item d-none d-sm-inline-block">
        <a href="http://lucasconde.ddns.net/DewRosas" class="nav-link">Inicio</a>
      </li> -->
    </ul>

    <!-- SEARCH FORM -->
    <form class="form-inline ml-3">
      <div class="input-group input-group-sm">
        <input class="form-control form-control-navbar" type="search" placeholder="Search" aria-label="Search">
        <div class="input-group-append">
          <button class="btn btn-navbar" type="submit">
            <i class="fas fa-search"></i>
          </button>
        </div>
      </div>
    </form>

  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="http://lucasconde.ddns.net/DewRosas/" class="brand-link" style="text-decoration: none;">
      <img src="../../assets/Img/example.jpg" alt="AdminLTE Logo" class="brand-image img-circle elevation-3"
           style="opacity: 0">
      <span class="brand-text font-weight-light">Dew Rosas</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
          <img src="http://lucasconde.ddns.net/DewRosas/assets/Img/<?php echo $arregloUsuario['imagen']?>" class="img-circle elevation-2" alt="<?php echo $arregloUsuario['nombre']?>">
        </div>
        <div class="info">
          <a href="#" class="d-block"><?php echo $arregloUsuario['nombre'] . " " . $arregloUsuario['apellido']?></a>
        </div>
      </div>


      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

            <li class="nav-item">
                <a href="http://lucasconde.ddns.net/DewRosas/admin/index.php" class="nav-link">
                    <i class="nav-icon fas fa-home"></i>
                    <p>Inicio</p>
                </a>
            </li>

            <li class="nav-item">
                <a href="http://lucasconde.ddns.net/DewRosas/admin/pedidos.php" class="nav-link">
                    <i class="nav-icon fas fa-cart-plus"></i>
                    <p>Pedidos</p>
                </a>
            </li>
            <?php
              if($arregloUsuario['nivel']== 'admin'){ ?>
                  <li class="nav-item">
                      <a href="http://lucasconde.ddns.net/DewRosas/admin/productos.php" class="nav-link">
                          <i class="nav-icon fas fa-stream"></i>
                          <p>Productos</p>
                      </a>
                  </li>
                  <li class="nav-item">
                    <a href="../usuarios.php" class="nav-link">
                      <i class="nav-icon fas fa-users"></i>
                      <p>Usuarios</p>
                    </a>
                  </li>
                  
                  <li class="nav-item">
                    <a href="http://lucasconde.ddns.net/DewRosas/php/cerrar_sesion.php" class="nav-link">
                      <i class="nav-icon fas fa-power-off"></i>
                      <p>Salir</p>
                    </a>
                  </li>
            <?php } ?>
        </ul>
      </nav>
    </div>
  </aside>