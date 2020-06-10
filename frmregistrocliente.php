<?php
include_once("clases/conexion.php");
include_once("clases/cliente.php");
//---------- USES DE LAS CLASES DE NAMESPACES ----
use \clases\conexion\Conexion;
use \clases\cliente\Cliente;
//-----------------------------------------------
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

//=================verificnado metodo post
//funciones
function procesarAdicionar()
{
    //se pone global para acceder a las variables globales desde una funcion
    global $cliente;

    global $nombre;
    global $email;
    global $direccion;
    global $login;
    global $password;
    global $telefono;
    global $error;

    $nombre = $_POST["txtNombre"];
    $email = $_POST["txtEmail"];
    $direccion = $_POST["txtDireccion"];
    $login = $_POST["txtLogin"];
    $password = $_POST["txtPassword"];
    $telefono = $_POST["txtTelefono"];

    $cliente->inicializar(0, $nombre, $email, $direccion, $login, $password, $telefono);
    if ($cliente->guardar())
        header("location:index.php?msg=cliente registrado correctamente!!! puede iniciar session");
    else {
        $error = "Error al adicionar, revise los datos!!!";
    }
}
if (isset($_POST["btnAceptar"])) {
    $op = $_POST["txtOperacion"];
    switch ($op) {
        case 1:
            procesarAdicionar();
            break;
        case 2:
            // procesarModificar();
            break;
        case 3:
            //procesarEliminar();
            break;
        default:
            echo "no hay operacion";
            break;
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include("incluir_estilos_encabezado.php"); ?>
    <link rel="stylesheet" href="plugins/css/fondoC.css">
    <title>Registarse</title>
</head>
</style>

<body>
    <?php include("incluir_menu_principal.php"); ?>
    <div class="container">
        <div class="row justify-content-center mt-5 pt-5">

            <div class="col-md-7 bg-white">
                <h1 class="display-4">Registro de Clientes</h1>
                <hr class="bg-info">
                <!---------------------------------------------------------------->
                <div id="form-container" style="margin: 60px">
                    <form name="form1" action="frmregistrocliente.php" method="POST">

                        <div class="form-group">
                            <input type="hidden" class="form-control" id="txtOperacion" name="txtOperacion" value="1">
                        </div>

                        <div class="row form-group">
                            <label for="txtNombre" class="col-form-label col-md-4">Nombre </label>
                            <div class="col-md-8">
                                <input type="text" name="txtNombre" value="<?php echo $nombre; ?>" id="txtNombre" class="form-control">
                            </div>
                        </div>


                        <div class="row form-group">
                            <label for="txtEmail" class="col-form-label col-md-4">E-mail</label>
                            <div class="col-md-8">
                                <input type="email" name="txtEmail" value="<?php echo $email; ?>" id="txtEmail" class="form-control">
                            </div>
                        </div>

                        <div class="row form-group">
                            <label for="txtDireccion" class="col-form-label col-md-4">Direccion</label>
                            <div class="col-md-8">
                                <input type="text" name="txtDireccion" value="<?php echo $direccion; ?>" id="txtDireccion" class="form-control">
                            </div>
                        </div>

                        <div class="row form-group">
                            <label for="txtLogin" class="col-form-label col-md-4">Login </label>
                            <div class="col-md-8">
                                <input type="text" name="txtLogin" value="<?php echo $login; ?>" id="txtLogin" class="form-control">
                            </div>
                        </div>

                        <div class="row form-group">
                            <label for="txtPassword" class="col-form-label col-md-4">Password </label>
                            <div class="col-md-8">
                                <input type="password" name="txtPassword" value="<?php echo $password; ?>" id="txtPassword" class="form-control">
                            </div>
                        </div>

                        <div class="row form-group">
                            <label for="txtTelefono" class="col-form-label col-md-4">Telefono</label>
                            <div class="col-md-8">
                                <input type="text" name="txtTelefono" value="<?php echo $telefono; ?>" id="txtTelefono" class="form-control">
                            </div>
                        </div>

                        <button type="submit" class="btn btn-info" name="btnAceptar" value="Aceptar">Aceptar</button>
                        <button type="submit" class="btn btn-default" name="btnCancelar" value="Cancelar">Cancelar</button>

                    </form>
                    <hr class="bg-info">
                    <!--si la varible errores no esta vacia-->
                    <?php if (!empty($error)) : ?>
                        <div class="alert alert-danger" role="alert">
                            <?php echo $error; ?>
                        </div>
                    <?php endif ?>
                </div>
                <!---------------------------------------------------------------->
            </div>
        </div>
    </div>

    <?php include("incluir_estilos_pie.php"); ?>
</body>

</html>