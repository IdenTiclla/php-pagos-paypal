<div class="container-fluid navbar-inverse fixed-top scrolling-navbar">

    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <a class="navbar-brand" href="index.php"><img src="../plugins/img/logo.png" width="40" height="40" alt="img" srcset="">Electro-Shop</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav ml-auto">

                <li class="nav-item">
                    <a class="nav-link" href="frmproducto.php"><i class="fas fa-parking"></i> <span class="clearfix d-none d-sm-inline-block">Productos</span></a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="frmcliente.php"><i class="fas fa-copyright"></i> <span class="clearfix d-none d-sm-inline-block">Clientes</span></a>
                </li>

                <li class="nav-item">
                    <a class="nav-link" href="frmventas.php"><i class="fas fa-shopping-bag"></i> <span class="clearfix d-none d-sm-inline-block">Ventas</span></a>
                </li>

                <li class="nav-item dropdown active">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <i class="fas fa-user"></i>
                        <?php
                        //---------- USES DE LAS CLASES DE NAMESPACES ----
                        use \clases\ctrl_session\Ctrl_Session;
                        //-----------------------------------------------
                        $nombre_usuario = Ctrl_Session::get_nombre_usuario();
                        echo $nombre_usuario;
                        ?>
                    </a>
                    <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                        <a class="dropdown-item" href="frmcerrarseccion.php">Cerrar seccion</a>
                        <a class="dropdown-item" href="frmreportesventas.php">Mi reporte</a>
                        <a class="dropdown-item" href="#">Mi cuenta</a>
                    </div>
                </li>

            </ul>

            <ul class="navbar-nav nav-flex-icons">
                <li class="nav-item"><a href="#" class="nav-link"><i class="fab fa-facebook"> </i></a></li>

            </ul>
        </div>
</div>
</nav>