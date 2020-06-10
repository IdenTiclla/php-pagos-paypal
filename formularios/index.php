<?php
require_once("../clases/ctrl_session.php");
//---------- USES DE LAS CLASES DE NAMESPACES ----
use \clases\ctrl_session\Ctrl_Session;
//-----------------------------------------------
Ctrl_Session::verificar_inicio_session();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <?php include("../incluir_estilos_encabezado.php"); ?>
  <link rel="stylesheet" href="../plugins/css/ihover.css">
  <link rel="stylesheet" href="../plugins/css/fondoG.css">
  <title>Bienvenido</title>
</head>

<body>
  <div class="container-fluid">
    <div class="menu">
    <?php include("incluir_menu_formularios.php"); ?>
      
    </div>

    <!-- Footer -->
    <footer class="page-footer font-small unique-color-dark pt-4">

      <!-- Footer Elements -->
      <div class="container">

        <!-- Call to action -->
        <ul class="list-unstyled list-inline text-center py-5">
          <li class="list-inline-item">
           <img src="../plugins/img/logo.png" width="100" height="100" alt="img" srcset="">
          </li>
          <li class="list-inline-item">
            <h1 class="font-weight-bold">Electro-Shop</h1>
          </li>
        </ul>
        <!-- Call to action -->

      </div>
      <!-- Footer Elements -->

      <!-- Copyright -->
      <div class="footer-copyright text-center py-3">© 2020 Copyright Bolivia:
        <a href="#"> ElectroShop.com</a>
       
      </div>
      <!-- Copyright -->
      

    </footer>
    <!-- Footer -->




    <div class="row justify-content-center mt-5 pt-5">
      <div class="col-md-3 col-sm-6">
        <div class="ih-item square effect2  bg-white">
          <a href="frmventas.php" class="" id="">
            <div class="img">
              <img src="../plugins/img/televisor.jpg" alt="img" srcset="">
            </div>
            <div class="info">
              <h3>Compra a hora</h3>
              <p>20% de descuento</p>
            </div>
          </a>
        </div>
      </div>
      <br>


      <div class="col-md-3 col-sm-6">
        <div class="ih-item square effect3  bg-white">
          <a href="frmventas.php" class="" id="">
            <div class="img">
              <img src="../plugins/img/portatil.jpg" alt="img" srcset="">
            </div>
            <div class="info">
              <h3>Compra a hora</h3>
              <p>Con 10% de descuentos</p>
            </div>
          </a>
        </div>
      </div>

      <div class="col-md-3 col-sm-6">
        <div class="ih-item square effect6">
          <a href="frmventas.php" class="" id="">
            <div class="img">
              <img src="../plugins/img/ordenador.jpg" alt="img" srcset="">
            </div>
            <div class="info">
              <h3>Compra a hora</h3>
              <p>DELL</p>
            </div>
          </a>
        </div>
      </div>
      <!---->

    </div>

    <div class="row justify-content-center mt-5 pt-5" style="margin-top: 30px;">
      <div class="col-md-3 col-sm-6">
        <div class="ih-item circle effect1">
          <a href="frmventas.php">
            <div class="spinner"></div>
            <div class="img">
              <img src="../plugins/img/router.jpg" alt="img" srcset="">
            </div>
            <div class="info">
              <div class="info-back">
                <h3>Router</h3>
                <p>TP-LINK</p>

              </div>
            </div>
          </a>
        </div>
      </div>

      <div class="col-md-3 col-sm-6">
        <div class="ih-item circle effect2 left_to_right">
          <a href="frmventas.php">
            <div class="img">
              <img src="../plugins/img/portatildell.jpg" alt="img" srcset="">
            </div>
            <div class="info">
              <div class="info-back">
                <h3>Portatil</h3>
                <p>Dell</p>

              </div>
            </div>
          </a>
        </div>
      </div>

      <div class="col-md-3 col-sm-6">
        <div class="ih-item circle effect1">
          <a href="frmventas.php">
            <div class="spinner"></div>
            <div class="img">
              <img src="../plugins/img/telefono.png" alt="img" srcset="">
            </div>
            <div class="info">
              <div class="info-back">
                <h3>Samsung</h3>
                <p>A10s</p>

              </div>
            </div>
          </a>
        </div>
      </div>

    </div>


  </div>
  <?php include("../incluir_estilos_pie.php"); ?>
</body>

</html>