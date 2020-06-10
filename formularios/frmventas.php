<?php
require_once("../clases/ctrl_session.php");
require_once("../clases/producto.php");
require_once("../clases/conexion.php");
require_once("../clases/array_list.php");
require_once("../clases/detalleventa.php");
//---------- USES DE LAS CLASES DE NAMESPACES ----
use \clases\ctrl_session\Ctrl_Session;
use clases\producto\Producto;
use clases\conexion\Conexion;
use clases\detalleventa\DetalleVenta;

$cnx = new Conexion();
//-----------------------------------------------
Ctrl_Session::verificar_inicio_session();
$nombre_usuario = Ctrl_Session::get_nombre_usuario();

/*-----------------------------PROGAMANDO DEL PRODUCTO SELECCIONADO */
$mensaje = "";
//si hizo click en el boton adicionar
if (isset($_POST['btnAddCarrito'])) {

    $id_adicionar = $_POST["id-name"];
    $nombre_adicionar = $_POST['nombre-name'];
    $precio_adicionar = $_POST["precio-name"];
    //$cantidadexistente_adicionar = $_POST["cantidad-name"];
    $cantidadadd_adicionar = $_POST["cantidadadd-name"];

    //preguntamos si no tenemos un array con la clave carrito
    //si no es el primero que agregamos
    if (!isset($_SESSION["carrito"])) {
        $objCarrito = new ArrayList();
        //lo guardamos en el objeto la session carrito
        $_SESSION["carrito"] = $objCarrito;
    }

    //pero si tenemos un array  que nos devuelva
    $objCarrito = $_SESSION["carrito"];
    $objDetalleProducto = new DetalleVenta($cnx);
    //$id, $producto_id, $venta_id, $cantidad,$precio
    //seteamos los avalores
    $objDetalleProducto->inicializar(0, $id_adicionar, 0, $cantidadadd_adicionar, $precio_adicionar, $nombre_adicionar);
    $objCarrito->Add($objDetalleProducto);
    //guardamos el carrito en la seccion
    $_SESSION["carrito"] = $objCarrito;

    $mensaje = "$nombre_adicionar adicionada correctamente";
}

?>
<!DOCTYPE html>
<html lang="en">

<head>

    <?php include("../incluir_estilos_encabezado.php"); ?>
    <link rel="stylesheet" href="../plugins/css/fondoG.css">
    <link rel="stylesheet" href="../plugins/css/ihover.css">

    <title>Ventas</title>
</head>

<body>
    <?php include("incluir_menu_formularios.php"); ?>

    <div class="container-fluid">


        <div class="row justify-content-center mt-5 pt-5">

            <div class="col-sm-12">
                <div class="card text-left">

                    <div class="card-header">
                        <H1><i class="fas fa-tags pr-2" aria-hidden="true"></i>Venta en linea</H1>
                        <h2><i class="fas fa-user-circle pr-2" aria-hidden="true"></i>Usuario: <?php echo ($nombre_usuario); ?></h2>
                    </div>

                    <!-- ---------- -->

                    <form action="frmventas.php" method="POST" name="form1">

                        <br>
                        <div class="input-group mb-3">
                            <input name="txtCriterio" type="text" class="form-control" placeholder="Nombre de produdcto a buscar" aria-label="Procto" aria-describedby="button-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-md btn-dark m-0 px-3 py-2 z-depth-0 waves-effect" type="submit" name="btnBuscar" id="btnBuscar">Buscar</button>
                            </div>
                        </div>



                    </form>
                    <h2>Resultado de la busqueda</h2>
                    <hr class="bg-info">
                    <div class="table-responsive">
                        <div class="row">
                            <?php
                            $criterio = "";
                            if (isset($_POST['btnBuscar'])) {
                                $criterio = $_POST['txtCriterio'];
                            }
                            $objProducto = new Producto($cnx);
                            $objProducto->buscar_producto_seleccion($criterio, "frmconfirmaradd.php");

                            ?>
                        </div>
                    </div>
                    <?php
                    /* ***alert dialog */
                    if (!empty($mensaje)) {
                        echo "<div class='alert alert-success' role='alert'> $mensaje </div>";
                    }
                    ?>
                    <div class="col-md-12 mb-4">
                        <a href="frmcarrito.php" class="btn btn-elegant btn-lg active" role="button" aria-pressed="true"><i class="fas fa-shopping-cart pr-2" aria-hidden="true"></i>Ver carrito</a>
                    </div>
                    <!-- ------------ -->
                </div>
            </div>
        </div>

        <!-- ********************************FORMULARIO MODAL*********************************** -->
        <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Adicionar Producto</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form id="frmAdicionarCarrito" method="POST" action="frmventas.php">
                            <div class="form-group">
                                <label for="id-name" class="col-form-label">ID:</label>
                                <input type="text" class="form-control" id="id-name" name="id-name" readonly>
                            </div>

                            <div class="form-group">
                                <label for="nombre-name" class="col-form-label">Nombre:</label>
                                <input type="text" class="form-control" id="nombre-name" name="nombre-name" readonly>
                            </div>

                            <div class="form-group">
                                <label for="precio-name" class="col-form-label">Precio:</label>
                                <input type="text" class="form-control" id="precio-name" name="precio-name" readonly>
                            </div>

                            <!--    <div class="form-group">
                                <label for="cantidad-name" class="col-form-label">Cantidad existente:</label>
                                <input type="text" class="form-control" id="cantidad-name" name="cantidad-name" readonly>
                            </div> -->

                            <div class="form-group">
                                <label for="cantidadadd-name" class="col-form-label">Cantidad a Add:</label>
                                <input type="number" class="form-control" id="cantidadadd-name" name="cantidadadd-name">
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <button type="submit" class="btn btn-primary" name="btnAddCarrito">Adicionar</button>
                            </div>

                        </form>
                    </div>

                </div>
            </div>
        </div>
        <!-- scrip -->

        <script>
            window.onload = function() {
                $('#exampleModal').on('show.bs.modal', function(event) {
                    var button = $(event.relatedTarget) // Button that triggered the modal
                    var id = button.data('id')
                    var nombre = button.data('nombre')
                    var precio = button.data('precio')
                    var cantidad = button.data('id') // Extract info from data-* attributes
                    /*para que carge los datos al input primero ingreamos el id del objeto y despues su nuevo valor*/
                    $("#id-name").val(id)
                    $("#nombre-name").val(nombre)
                    $("#precio-name").val(precio)
                    $("#cantidad-name").val(cantidad)
                    $("#cantidadadd-name").val(1)
                    // If necessary, you could initiate an AJAX request here (and then do the updating in a callback).
                    // Update the modal's content. We'll use jQuery here, but you could use a data binding library or other methods instead.
                    //var modal = $(this)
                    //modal.find('.modal-title').text('New message to ' + recipient)
                    //modal.find('.modal-body input').val(recipient)
                });
            }
        </script>
        <!-- ----------------------------------------------------------------------------------------------------------------------------- -->
    </div>
    <?php include("../incluir_estilos_pie.php"); ?>
</body>

</html>