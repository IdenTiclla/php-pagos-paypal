<?php
include_once("../clases/conexion.php");
include_once("../clases/producto.php");
require_once("../clases/ctrl_session.php");
//---------- USES DE LAS CLASES DE NAMESPACES ----
use \clases\ctrl_session\Ctrl_Session;
use \clases\conexion\Conexion;
use \clases\producto\Producto;
//-----------------------------------------------
Ctrl_Session::verificar_inicio_session();
$nombre_usuario = Ctrl_Session::get_nombre_usuario();

$cnx = new Conexion();
$producto = new Producto($cnx);
$criterio = "";

if (isset($_POST["btnbuscar"])) {
    $criterio = $_POST["txtcriterio"];
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <?php include("../incluir_estilos_encabezado.php"); ?>
    <link rel="stylesheet" href="../plugins/css/fondoG.css">
    <title>Producto</title>
</head>

<body>
    <?php include("incluir_menu_formularios.php"); ?>
    <div class="container">

        <div class="row justify-content-center mt-5 pt-5">

            <div class="col-sm-12">
                <div class="card text-left">

                    <div class="card-header">
                        <h1 class="display-4">Producto</h1>
                    </div>
                    <!--sistema de columna--------------------------->
                    <div class="card-body">
                        <form action="frmproducto.php" method="post">


                            <div class="input-group mb-3">
                                <input type="txtcriterio"  name="txtcriterio" value="<?php echo $criterio;  ?>" id="txtcriterio" class="form-control" placeholder="Buscar por Nombre" aria-label="Buscar por Nombre" aria-describedby="button-addon2">
                                <div class="input-group-append">
                                    <button class="btn btn-md btn-dark m-0 px-3 py-2 z-depth-0 waves-effect" type="submit" name="btnbuscar" id="btnbuscar"><i class="fas fa-search pr-2" aria-hidden="true"></i>Busacar por nombre</button>
                                </div>
                            </div>

                            <hr class="bg-info">
                            <div class="table-responsive">
                            <?php
                            if (isset($_POST["btnbuscar"])) {
                                $producto->buscarabm($criterio, "frmabmproducto.php");
                            }
                            ?>
                            </div>
                        </form>
                        <br>
                        <a class="btn btn-dark"  href="frmabmproducto.php?op=1" role="button"><i class="fas fa-plus-circle pr-2" aria-hidden="true"></i>Adicionar</a>
                        <hr class="bg-info">
                        <!--si la varible errores no esta vacia-->
                        <?php if (isset($_GET["msg"])) : ?>
                            <div class="alert alert-success" role="alert">
                                <?php echo $_GET["msg"]; ?>
                            </div>
                        <?php endif ?>
                    </div>
                    <!-- ----------------------------------------- -->
                </div>
            </div>
        </div>
    </div>

    <?php include("../incluir_estilos_pie.php"); ?>
</body>

</html>