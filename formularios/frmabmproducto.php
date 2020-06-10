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

$id = 0;
$categoria_id = 0; //
$nombre = "";
$marca = "";
$descripcion = "";
$precio = "";
$cantidad = "";
$imagen = "";

$op = 0;
$operacion = "";
$error = "";

if (isset($_GET["id"])) {
    $op = $_GET["op"];
    $id = $_GET["id"];
    if ($producto->traerporid($id)) {
        $categoria_id = $producto->getCategoria_id(); ///
        $nombre = $producto->get_nombre();
        $marca = $producto->get_marca();
        $descripcion = $producto->get_descripcion();
        $precio = $producto->get_precio();
        $cantidad = $producto->get_cantidad();
        $imagen = $producto->get_imagen();
    } else

        header("location:frmproducto.php?msg=no existe el producto");
    switch ($op) {
        case 2:
            $operacion = "Modificar";
            break;
        case 3:
            $operacion = "Eliminar";
            break;
        default:
            header("location:frmproducto.php?msg=operacion no definida");
    }
} else {
    // adicionar nuevo
    if (isset($_GET["op"]) && $_GET["op"] == 1) {
        $op = 1;
        $operacion = "Adicionar";
    }
}
//------------------ verificando el metodo post --------------------
//funcioens
function procesar_adicionar()
{
    global $cnx;
    global $producto;

    global $categoria_id; //
    global $nombre;
    global $marca;
    global $descripcion;
    global $precio;
    global $cantidad;
    global $error;
    global $imagen;
    $categoria_id = $_POST["txtselect"]; //
    $nombre = $_POST["txtnombre"];
    $marca = $_POST["txtmarca"];
    $descripcion = $_POST["txtdescripcion"];
    $precio = $_POST["txtprecio"];
    $cantidad = $_POST["txtcantidad"];
    $imagen = $_POST['txtimagen'];
   // $imagen = $_FILES['imagen']['name'];
    //$imagen = $_FILES["imagen"]["name"];

  /*   $tipo_imagen = $_FILES["imagen"]["type"];
    $tamano_imagen = $_FILES["imagen"]["size"];
    $tmp_name = $_FILES["imagen"]["tmp_name"];

    if ($tamano_imagen <= 1000000 && ($tipo_imagen == "imagen/jpg" || $tipo_imagen == "imagen/jpeg" || $tipo_imagen == "imagen/png")) {
        $carpeta_destino = $_SERVER["DOCUMENT_ROOT"] . "/clases/fotos/";
        move_uploaded_file($tmp_name, $carpeta_destino . $imagen);
    } else {
        $mesaje_error = "El tamaño de la imagen o el formato no es correcto.";
    } */


    /* if (empty($_FILES)) {
        //coprueba la imagen
        $check = @getimagesize($_FILES['txtimagen']['temp_name']);
        if ($check !== false) {
            $carpeta_destino = 'fotos/';
            $archivo_subido = $carpeta_destino . $_FILES['txtimagen']['name'];
            move_uploaded_file($_FILES['txtimagen']['temp_name'], $archivo_subido);
        }
    } */
    $producto->inicializar(0, $categoria_id, $nombre, $marca, $descripcion, $precio, $cantidad, $imagen);
    if ($producto->guardar())
        header("location:frmproducto.php?msg=guardado correctamente!!!");
    else
        $error = "Error al adicionar revise los datos !!!";
}
function procesar_modificar()
{ //dentro de la funcio no puedo accedr a las variables globales 
    //si quiero acceder tengo que explicitar con la palabra global
    global $cnx;
    global $producto;
    global $id;
    global $categoria_id; //
    global $nombre;
    global $marca;
    global $descripcion;
    global $precio;
    global $cantidad;
    global $imagen;
    global $error;
    $id = $_POST["txtid"];
    $categoria_id = $_POST["txtselect"]; //
    $nombre = $_POST["txtnombre"];
    $marca = $_POST["txtmarca"];
    $descripcion = $_POST["txtdescripcion"];
    $precio = $_POST["txtprecio"];
    $cantidad = $_POST["txtcantidad"];
    $imagen = $_POST["txtimagen"];
    $producto->inicializar($id, $categoria_id, $nombre, $marca, $descripcion, $precio, $cantidad, $imagen);
    if ($producto->modificar())
        header("location:frmproducto.php?msg=modificado correctamente!!!");
    else
        $error = "Error al modificar revise los datos !!!";
}
function procesar_eliminar()
{ //dentro de la funcio no puedo accedr a las variables globales 
    //si quiero acceder tengo que explicitar con la palabra global
    global $cnx;
    global $producto;
    global $id;
    global $categoria_id; //
    global $nombre;
    global $marca;
    global $descripcion;
    global $precio;
    global $cantidad;
    global $error;
    $id = $_POST["txtid"];
    $categoria_id = $_POST["txtselect"]; //
    $nombre = $_POST["txtnombre"];
    $marca = $_POST["txtmarca"];
    $descripcion = $_POST["txtdescripcion"];
    $precio = $_POST["txtprecio"];
    $cantidad = $_POST["txtcantidad"];
    $imagen = $_POST["txtimagen"];
    $producto->inicializar($id, $categoria_id, $nombre, $marca, $descripcion, $precio, $cantidad, $imagen);
    if ($producto->eliminar())
        header("location:frmproducto.php?msg=eliminado correctamente!!!");
    else
        $error = "Error al eliminar revise los datos !!!";
}
//------------------------------------------------------------------
if (isset($_POST["btnaceptar"])) {
    $op = $_POST["txtoperacion"];
    switch ($op) {
        case 1:
            procesar_adicionar();
            break;
        case 2:
            procesar_modificar();
            break;
        case 3:
            procesar_eliminar();
            break;
    }
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

    <div class="container">
        <?php include("incluir_menu_formularios.php"); ?>
        <div class="row justify-content-center mt-5 pt-5">
            <!--sistema de columna-->
            <!-------------------------------------------------------------------------------->
            <div class="col-md-7 bg-white">
                <h1 class="display-4">Registro de productos</h1>
                <hr class="bg-info">

                <div class="alert alert alert-warning" role="alert">
                    <h4 class="alert-heading">Operacion: <?php echo $operacion; ?></h4>
                </div>

                <form name="form1" action="frmabmproducto.php" method="post">

                    <input type="hidden" name="txtoperacion" value="<?php echo $op; ?>">

                    <div class="row form-group">
                        <label for="txtid" class="col-form-label col-md-4">ID de producto</label>
                        <div class="col-md-8">
                            <input type="text" name="txtid" value="<?php echo $id; ?>" id="txtid" class="form-control" readonly>
                        </div>
                    </div>

                    <div class="row form-group">
                        <label for="txtnombre" class="col-form-label col-md-4">Nombre del producto</label>
                        <div class="col-md-8">
                            <input type="text" name="txtnombre" value="<?php echo $nombre; ?>" id="txtnombre" class="form-control">
                        </div>
                    </div>

                    <div class="row form-group">
                        <label for="txtcategoria" class="col-form-label col-md-4">Categoria del producto</label>
                        <div class="col-md-8">
                            <?php $producto->obtenercategoria(); ?>
                        </div>


                    </div>

                    <div class="row form-group">
                        <label for="txtmarca" class="col-form-label col-md-4">Marca</label>
                        <div class="col-md-8">
                            <input type="text" name="txtmarca" value="<?php echo $marca; ?>" id="txtmarca" class="form-control">
                        </div>
                    </div>


                    <div class="row form-group">
                        <label for="txtdescripcion" class="col-form-label col-md-4">Descripcion</label>
                        <div class="col-md-8">
                            <input type="text" name="txtdescripcion" value="<?php echo $descripcion; ?>" id="txtdescripcion" class="form-control">
                        </div>
                    </div>


                    <div class="row form-group">
                        <label for="txtprecio" class="col-form-label col-md-4">Precio del producto</label>
                        <div class="col-md-8">
                            <input type="number" step="0.01" name="txtprecio" value="<?php echo $precio; ?>" id="txtprecio" class="form-control">
                        </div>
                    </div>

                    <div class="row form-group">
                        <label for="txtcantidad" class="col-form-label col-md-4">Cantidad de producto</label>
                        <div class="col-md-8">
                            <input type="number" name="txtcantidad" value="<?php echo $cantidad; ?>" id="txtcantidad" class="form-control">
                        </div>
                    </div>

                    <div class="row form-group">
                        <label for="txtimagen" class="col-form-label col-md-4">Imagen del producto(url)</label>
                        <div class="col-md-8">
                            <input type="text" name="txtimagen" value="<?php echo $imagen; ?>" id="txtimagen" class="form-control">
                        </div>
                    </div>


                
                    <button type="submit" class="btn btn-dark" name="btnaceptar" id="btnaceptar">Aceptar</button>
                    <a class="btn btn-dark" href="frmproducto.php" role="button">Cancelar</a>
                    <hr class="bg-info">
                </form>


                <!--si la varible errores no esta vacia-->
                <?php if (!empty($error)) : ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo $error; ?>
                    </div>
                <?php endif ?>

            </div>
        </div>

    </div>

    <?php include("../incluir_estilos_pie.php"); ?>
</body>

</html>