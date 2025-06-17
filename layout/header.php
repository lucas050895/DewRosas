<header>
    <nav>
        <div class="menu-icon">
            <span></span>
            <span></span>
            <span></span>
        </div>
        <div class="menu-overlay">
            <ul class="menu-items">
            <li><a href="http://lucasconde.ddns.net/DewRosas">Inicio</a></li>
            <li><a href="http://lucasconde.ddns.net/DewRosas/vistas/acerca">Acerca de</a></li>
            <li><a href="http://lucasconde.ddns.net/DewRosas/vistas/login">Iniciar Sesión</a></li>
            </ul>
        </div>
    </nav>

    <h1>
        <a href="http://lucasconde.ddns.net/DewRosas">
            Dew Roses<br>
            <span>LENCERIA</span>
        </a>
    </h1>

    <div class="carrito">
        <a href="http://lucasconde.ddns.net/DewRosas/vistas/carrito">
            <i class='bx bx-cart'></i>
            <span>
            <?php
                if (isset($_SESSION['carrito'])) {
                    echo count($_SESSION['carrito']);
                } else {
                    echo 0;
                }
            ?> 
            </span>
        </a>
    </div>
</header>
