<?php
include_once("../clases/conexion.php");
include_once("../clases/cliente.php");
require_once("../clases/ctrl_session.php");
//---------- USES DE LAS CLASES DE NAMESPACES ----
use \clases\ctrl_session\Ctrl_Session;
use \clases\conexion\Conexion;
use \clases\cliente\Cliente;
//-----------------------------------------------
Ctrl_Session::verificar_inicio_session();
$nombre_usuario = Ctrl_Session::get_nombre_usuario();

$cnx = new Conexion();
$cliente = new Cliente($cnx);

$id = 0;
$nombre = "";
$email = "";
$direccion = "";
$login = "";
$password = "";
$telefono = "";

$op = 0;
$operacion = "";
$error = "";

if (isset($_GET["id"])) {
    $op = $_GET["op"];
    $id = $_GET["id"];

    if ($cliente->traerporid($id)) {
        $nombre = $cliente->get_nombre();
        $email = $cliente->get_email();
        $direccion = $cliente->get_direccion();
        $login = $cliente->get_login();
        $password = $cliente->get_password();
        $telefono = $cliente->get_telefono();
    } else
        header("location:frmcliente.php?msg=no existe el cliente");
    switch ($op) {
        case 2:
            $operacion = "Modificar";
            break;
        case 3:
            $operacion = "Eliminar";
            break;
        default:
            header("location:frmcliente.php?msg=operacion no definida");
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
{ //dentro de la funcio no puedo accedr a las variables globales 
    //si quiero acceder tengo que explicitar con la palabra global
    //global $cnx;

    global $cliente;
    global $nombre;
    global $email;
    global $direccion;
    global $login;
    global $password;
    global $telefono;
    global $error;

    $nombre = $_POST['txtnombre'];
    $email = $_POST['txtemail'];
    $direccion = $_POST['txtdireccion'];
    $login = $_POST['txtlogin'];
    $password = $_POST['password'];
    $telefono = $_POST['telefono'];


    $cliente->inicializar(0, $nombre, $email, $direccion, $login, $password, $telefono);
    if ($cliente->guardar())
        header("location:frmcliente.php?msg=guardado correctamente!!!");
    else {
        $error = "Error al adicionar revise los datos !!!";
    }
}
function procesar_modificar()
{ //dentro de la funcio no puedo accedr a las variables globales 
    //si quiero acceder tengo que explicitar con la palabra global
    global $cliente;
    global $nombre;
    global $email;
    global $direccion;
    global $login;
    global $password;
    global $telefono;
    global $error;

    $id = $_POST["txtid"];
    $nombre = $_POST['txtnombre'];
    $email = $_POST['txtemail'];
    $direccion = $_POST['txtdireccion'];
    $login = $_POST['txtlogin'];
    $password = $_POST['password'];
    $telefono = $_POST['telefono'];

    $cliente->inicializar($id, $nombre, $email, $direccion, $login, $password, $telefono);
    if ($cliente->modificar())
        header("location:frmcliente.php?msg=modificado correctamente!!!");
    else
        $error = "Error al modificar revise los datos !!!";
}
function procesar_eliminar()
{ //dentro de la funcio no puedo accedr a las variables globales 
    //si quiero acceder tengo que explicitar con la palabra global
    global $cliente;
    global $nombre;
    global $email;
    global $direccion;
    global $login;
    global $password;
    global $telefono;
    global $error;

    $id = $_POST["txtid"];
    $nombre = $_POST["txtnombre"];
    $email = $_POST['txtemail'];
    $direccion = $_POST['txtdireccion'];
    $login = $_POST['txtlogin'];
    $password = $_POST['password'];
    $telefono = $_POST['telefono'];

    $cliente->inicializar($id, $nombre, $email, $direccion, $login, $password, $telefono);
    if ($cliente->eliminar())
        header("location:frmcliente.php?msg=eliminado correctamente!!!");
    else
        $error = "Error al eliminar revise los datos !!!";
}
//------------------------------------------------------------------
if (isset($_POST["btnaceptar"])) {
    $op = $_POST["txtoperacion"];
    switch ($op) {
            /*   case 1:
            procesar_adicionar();
            break; */
        case 1:
            if (
                preg_match('/^[^0-9][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[@][a-zA-Z0-9_]+([.][a-zA-Z0-9_]+)*[.][a-zA-Z]{2,4}$/', $_POST["txtEmail"]) &&
                preg_match('/^[0-9a-zA-Z]+$/', $_POST["txtPassword"]) && preg_match('/^[0-9a-zA-Z]+$/', $_POST["txtLogin"])
            )
             {
                procesarAdicionar();
                break;
            }

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
    <title>Cliente</title>
</head>

<body>
    <?php include("incluir_menu_formularios.php"); ?>
    <div class="container">
        <div class="row justify-content-center mt-5 pt-5">
            <!--sistema de columna-->
            <!-------------------------------------------------------------------------------->
            <div class="col-md-7 bg-white">
                <h1 class="display-4">Registro de Cliente</h1>
                <hr class="bg-info">

                <div class="alert alert alert-warning" role="alert">
                    <h4 class="alert-heading">Operacion: <?php echo $operacion; ?></h4>
                </div>

                <form name="form1" action="frmabmcliente.php" method="post">

                    <input type="hidden" name="txtoperacion" value="<?php echo $op; ?>">

                    <div class="row form-group">
                        <label for="txtid" class="col-form-label col-md-4">ID de cliente</label>
                        <div class="col-md-8">
                            <input type="text" name="txtid" value="<?php echo $id; ?>" id="txtid" class="form-control" readonly>
                        </div>
                    </div>

                    <div class="row form-group">
                        <label for="nombre" class="col-form-label col-md-4">Nombre </label>
                        <div class="col-md-8">
                            <input type="text" name="txtnombre" value="<?php echo $nombre; ?>" id="txtnombre" class="form-control">
                        </div>
                    </div>


                    <div class="row form-group">
                        <label for="email" class="col-form-label col-md-4">E-mail</label>
                        <div class="col-md-8">
                            <input type="email" name="txtemail" value="<?php echo $email; ?>" id="txtemail" class="form-control">
                        </div>
                    </div>

                    <div class="row form-group">
                        <label for="direccion" class="col-form-label col-md-4">Direccion</label>
                        <div class="col-md-8">
                            <input type="text" name="txtdireccion" value="<?php echo $direccion; ?>" id="txtdireccion" class="form-control">
                        </div>
                    </div>

                    <div class="row form-group">
                        <label for="login" class="col-form-label col-md-4">Login </label>
                        <div class="col-md-8">
                            <input type="text" name="txtlogin" value="<?php echo $login; ?>" id="txtlogin" class="form-control">
                        </div>
                    </div>

                    <div class="row form-group">
                        <label for="password" class="col-form-label col-md-4">Password </label>
                        <div class="col-md-8">
                            <input type="password" name="password" value="<?php echo $password; ?>" id="password" class="form-control">
                        </div>
                    </div>

                    <div class="row form-group">
                        <label for="telefono" class="col-form-label col-md-4">Telefono</label>
                        <div class="col-md-8">
                            <input type="text" name="telefono" value="<?php echo $telefono; ?>" id="telefono" class="form-control">
                        </div>
                    </div>


                    <button type="submit" class="btn btn-dark" name="btnaceptar" id="btnaceptar">Aceptar</button>
                    <a class="btn btn-dark" href="frmcliente.php" role="button">Cancelar</a>
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