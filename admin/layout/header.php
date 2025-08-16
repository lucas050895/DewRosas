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

  </nav>

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="http://lucasconde.ddns.net/DewRosas/" class="brand-link" style="text-decoration: none;">
      <span class="brand-text font-weight-light">Dew Rosas</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="info">
          <?php echo $arregloUsuario['nombre'] . " " . $arregloUsuario['apellido']?>
        </div>
      </div>


      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">

            <li class="nav-item">
                <a href="http://lucasconde.ddns.net/DewRosas/admin/index" class="nav-link">
                    <i class="nav-icon fas fa-home"></i>
                    <p>Inicio</p>
                </a>
            </li>

            <li class="nav-item">
                <a href="http://lucasconde.ddns.net/DewRosas/admin/pedidos" class="nav-link">
                    <i class="nav-icon fas fa-cart-plus"></i>
                    <p>Pedidos</p>
                </a>
            </li>
            <?php
              if($arregloUsuario['nivel']== 'admin'){ ?>
                  <li class="nav-item">
                    <a href="http://lucasconde.ddns.net/DewRosas/admin/productos" class="nav-link">
                        <i class="nav-icon fas fa-stream"></i>
                        <p>Productos</p>
                    </a>
                  </li>
                  
                  <li class="nav-item">
                    <a href="http://lucasconde.ddns.net/DewRosas/php/cerrar_sesion" class="nav-link">
                      <i class="nav-icon fas fa-power-off"></i>
                      <p>Salir</p>
                    </a>
                  </li>
            <?php } ?>
        </ul>
      </nav>
    </div>
  </aside>