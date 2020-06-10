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

$cnx = new Conexion();
$mensaje = "";
//----------------- PROCESAR CONFIRMAR VENTA ------------------------
if (isset($_GET["op"]) && $_GET["op"] == "confirmar" && isset($_SESSION["carrito"])) {

    $objCarrito = $_SESSION["carrito"];
    if ($objCarrito->Size() >= 1) {
        $objVenta = new Venta($cnx);
        $objVenta->set_cliente_id(Ctrl_Session::get_id_usuario());
        $objVenta->set_estado("P");
        $fecha = date("Y/m/d H:i:s");
        $objVenta->set_fecha($fecha);

        $idventa = Ctrl_Venta::guardar_venta($cnx, $objVenta, $objCarrito);
        if ($idventa > 0) {
            unset($_SESSION["carrito"]);
            header("location:index.php?msg=venta guardada correctamente nro $idventa");
        } else
            $mensaje = "Error al guardar los datos revise ...";
    } else
        $mensaje = "Error no se puede enviar una venta sin productos!!";
} else
   if (isset($_GET["op"]) && $_GET["op"] == "confirmar" && !isset($_SESSION["carrito"]))
    $mensaje = "El carrito esta vacio debe adicionar productos...";
//------------------ PROCESANDO QUITAR DEL CARRITO ---------------------------------
if (isset($_GET["key"])) {
    $key = $_GET["key"];
    $objCarrito = $_SESSION["carrito"];
    $objCarrito->remove($key);
    $_SESSION["carrito"] = $objCarrito;
}
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <?php include("../incluir_estilos_encabezado.php"); ?>
    <link rel="stylesheet" href="../plugins/css/fondoG.css">
    <link rel="stylesheet" href="../plugins/css/ihover.css">
    <title>Carrito acumulado para la venta</title>
</head>

<body>
    <?php include("incluir_menu_formularios.php"); ?>
    <div class="container">
        <div class="row justify-content-center mt-5 pt-5">

            <div class="col-sm-12">
                <div class="card text-left">

                    <div class="card-header">
                        <H1><i class="fas fa-shopping-cart pr-2" aria-hidden="true"></i>Carrito</H1>
                        <h2><i class="fas fa-user-circle pr-2" aria-hidden="true"></i>Usuario: <?php echo ($nombre_usuario); ?></h2>
                    </div>

                    <hr>
                    <h2>Productos acumulados</h2>
                    <div class="card-body">
                        <div class="table-responsive">
                            <!-- -------------------------------------------------------------------------------- -->
                            <?php
                            //aqui mostramos el carrito
                            echo "<table class='table table-striped table-dark'>";
                            echo "<thead>
                 <tr>
                     <th scope='col'>#</th>
                     <th scope='col'>Id.</th>
                     <th scope='col'>Nombre</th>
                     <th scope='col'>Precio $.</th>
                     <th scope='col'>Cantidad</th>
                     <th scope='col'>Total $.</th>
                     <th scope='col'>Quitar</th>
                 </tr>
             </thead>
             <tbody>";
                            $nro = 1;
                            //si existe algo en el carrito 
                            if (isset($_SESSION["carrito"])) {

                                //recuperamos lo que tenga en el carrito
                                $objCarrito = $_SESSION["carrito"];
                                $total = 0;
                                foreach ($objCarrito->list as $key => $registro) {
                                    $id = $registro->getProducto_id();
                                    $nombre = $registro->getNombre();
                                    $precio = $registro->getPrecio();
                                    $cantidad = $registro->getCantidad();
                                    $subtotal = $cantidad * $precio;
                                    $total = $total + $subtotal;
                                    // $linkseleccionar = "<a class='btn btn-outline-success' href='$paginadestino?id=$id&op=4'>Adicionar al carrito</a>";
                                    $linkseleccionar = "<a class='btn btn-outline-danger' href='frmcarrito.php?key=$key'><i class='fas fa-times pr-2 'aria-hidden='true'></i>Quitar</a>";



                                    echo "<tr>
                 <th scope='row'>$nro</th>
                 <td>$id</td>
                 <td>$nombre</td>
                 <td>$precio</td>
                 <td>$cantidad</td>
                 <td>$subtotal</td>
                 <td>$linkseleccionar</td>
                
                 </tr>";

                                    $nro++;
                                }
                                echo " 
        <tr>
            <th scope='col' colspan='5'>Total Ventas bs.:</th>
            <th scope='col'><p id='total'>$total</p></th>
            <th scope='col'></th>
        </tr>
            
            ";
                            }
                            echo "</tbody>
         </table>";
                            /* ***alert dialog */
                            if (!empty($mensaje)) {
                                echo "<div class='alert alert-danger' role='alert'> $mensaje </div>";
                            }
                            ?>
                        </div>
                        <a href="frmventas.php" class="btn purple-gradient btn-lg active" role="button" aria-pressed="true">Seguir Comprando</a>
                        <!-- Button trigger modal -->
                        <?php if (isset($_SESSION['carrito'])) { ?>
                            <button type="button" class="btn blue-gradient btn-lg active" data-toggle="modal" data-target="#staticBackdrop">
                                Confirmar venta
                            </button>
                        <?php } ?>
                    </div>


                </div>
            </div>
        </div>
        <!-------------------------------- VENTANA MODAL DE CONFIRMAR VENTA-------------------------------------------->
        <!-- Modal solo se muestra cuando se hace click -->
        <div class="modal fade" id="staticBackdrop" data-backdrop="static" data-keyboard="false" tabindex="-1" role="dialog" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Confirmar</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        Esta seguro de realizar la compra  <i class="fas fa-question-circle pr-2" aria-hidden="true"></i>
                        <p class="lead">¡ESTAS APUTO DE PAGAR!</p>
                        <p>Los productos podran ser enviados una vez que se procese el pago<br />
                            <strong>(Para aclaraciones : electroshop@gmail.com)</strong> 
                            <hr>
                            <div id="paypal-button-container"></div>
                            <!-- Include the PayPal JavaScript SDK -->
                            <script src="https://www.paypal.com/sdk/js?client-id=AaQriubJd1l8vD00eElLm0GfMPEUb6aDyuG-qVgwRuuDzvINoqvEpyr3RoDp8sGjtmwuaPCWcjmK5sRf&currency=USD"></script>
                            <!-- ********************************************************** -->
                    </div>

                </div>
            </div>
        </div>
        <!-- -------------------------------------------------------------------------------------------------------------------- -->
    </div>
    <?php include("../incluir_estilos_pie.php"); ?>
    <!-- SCRIPT PARA PAYPAL -->
    <script>
        function redireccionar() {
            window.location = "http://localhost:8080/Proyecto/formularios/frmcarrito.php?op=confirmar"
            // http://localhost:8080/Proyecto/formularios/frmcarrito.php
        }
        var amount = document.querySelector('#total').innerHTML;
        // Render the PayPal button into #paypal-button-container
        paypal.Buttons({

            // Set up the transaction
            createOrder: function(data, actions) {
                return actions.order.create({
                    purchase_units: [{
                        amount: {
                            value: amount
                        }
                    }]
                });
            },

            // Finalize the transaction
            onApprove: function(data, actions) {
                return actions.order.capture().then(function(details) {
                    //para ver que devuelve paypal
                    console.log(details);
                    // Show a success message to the buyer
                    //alert('Transaction completed by ' + details.payer.name.given_name + '!');
                    if (details.status === "COMPLETED") {
                        alert("se completo la transaccion")
                        setTimeout(redireccionar(), 5000); //tiempo expresado en milisegundos 
                    } else {
                        alert("no se completo la transaccion")
                    }

                });
            },
            onCancel: function(data) {
                alert("cancelaste la transaccion!")
            }


        }).render('#paypal-button-container');
    </script>
</body>

</html>