<?php
require_once("../clases/ctrl_session.php");
require_once("../clases/venta.php");
require_once("../clases/conexion.php");
//---------- USES DE LAS CLASES DE NAMESPACES ----
use \clases\ctrl_session\Ctrl_Session;
use \clases\venta\Venta;
use \clases\conexion\Conexion;
use clases\ctrl_venta\Ctrl_Venta;

//-----------------------------------------------
Ctrl_Session::verificar_inicio_session();

$cnx = new Conexion();

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <?php include("../incluir_estilos_encabezado.php"); ?>
  <link rel="stylesheet" href="../plugins/css/fondo1.css">
  <title>Reportes</title>
</head>

<body>
  <?php include("incluir_menu_formularios.php"); ?>

  <div class="container-fluid">
    <div class="row justify-content-center mt-5 pt-5">
      <div class="col-sm-12">
        <div class="card text-left">

          <div class="card-header">
            <H1><i class="fas fa-clipboard pr-2" aria-hidden="true"></i>Reporte de Ventas</H1>
            <h2><i class="fas fa-user-circle pr-2" aria-hidden="true"></i>Usuario: <?php echo ($nombre_usuario); ?></h2>
          </div>
          <div class="card-body">

            <div class="table-responsive">
              <?php
              $objVenta = new Venta($cnx);
              $objVenta->mostrarVentasPorCliente(Ctrl_Session::get_id_usuario(), "../reportes/rpt_listaventas.php");
              ?>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
  <?php include("../incluir_estilos_pie.php"); ?>
</body>

</html>