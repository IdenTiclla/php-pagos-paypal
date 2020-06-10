<?php

date_default_timezone_set("America/La_Paz"); //para cambiar la hora
//hosting usa, españa
require_once("../clases/producto.php");
require_once("../clases/ctrl_session.php");
require_once("../clases/conexion.php");
require_once("../clases/array_list.php");
require_once("../clases/detalleventa.php");
require_once("../clases/venta.php");
require_once("../clases/ctrl_venta.php");
//---------- USES DE LAS CLASES DE NAMESPACES ----
use \clases\ctrl_session\Ctrl_Session;
use clases\producto\Producto;
use clases\conexion\Conexion;
use clases\detalleventa\DetalleVenta;
use clases\venta\Venta;
use clases\ctrl_venta\Ctrl_Venta;
//-----------------------------------------------
Ctrl_Session::verificar_inicio_session();
$nombre_usuario = Ctrl_Session::get_nombre_usuario();
?>



<!DOCTYPE html>
<html lang="en">

<head>


    <?php include("../incluir_estilos_encabezado.php"); ?>
    <link rel="stylesheet" href="../plugins/css/fondoG.css">
    <!-- Add meta tags for mobile and IE -->
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>Producto</title>
</head>

<body>
    <?php include("incluir_menu_formularios.php"); ?>
    <div class="container-fluid">

        <div class="row justify-content-center mt-5 pt-5">
            <div class="jumbotron text-center">
                <h1 class="display-4">¡PASO FINAL!</h1>
                <hr class="my-4">
                <p class="lead">ESTAS APUTO DE PAGAR</p>
                <p>Los productos podran ser enviados una vez que se procese el pago<br />
                    <strong>(Para aclaraciones : electroshop@gmail.com)</strong>
                </p>
            </div>



        </div>
    </div>

    <?php include("../incluir_estilos_pie.php"); ?>
</body>

</html>