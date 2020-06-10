<?php
include_once("clases/conexion.php");
include_once("clases/cliente.php");
include_once("clases/ctrl_session.php");
//---------- USES DE LAS CLASES DE NAMESPACES ----
use \clases\ctrl_session\Ctrl_Session;
use \clases\conexion\Conexion;
use \clases\cliente\Cliente;
//-----------------------------------------------

$cnx = new Conexion();
$cliente = new Cliente($cnx);

$id = 0;
$login = "";
$password = "";

$error = "";

//=================verificnado metodo post
//funciones
function procesarIniciarSession()
{
    //se pone global para acceder a las variables globales desde una funcion
    global $cliente;
    global $login;
    global $password;
    global $error;


    $login = $_POST["txtLogin"];
    $password = $_POST["txtPassword"];

    if ($cliente->loguear($login, $password) == true) {
        //guardar datos en la session 
        // $_SESSION["login_usuario"]=$login;
        // $_SESSION["id_usuario"] = $cliente->get_id();
        // $_SESSION["nombre_usuario"] = $cliente->get_nombre();
        Ctrl_Session::iniciar_session($login, $cliente->get_id(), $cliente->get_nombre());
        header("location:formularios/index.php?msg=logueado correctamente");
    } else {
        $error = "Error al iniciar revise sus datos de acceso";
    }
}
if (isset($_POST["btnAceptar"])) {
    procesarIniciarSession();
}

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <?php include("incluir_estilos_encabezado.php"); ?>
    <link rel="stylesheet" href="plugins/css/fondoC.css">
    <title>Login</title>
</head>

<body>
    <?php include("incluir_menu_principal.php"); ?>

    <div class="container">
        <div class="row justify-content-center mt-5 pt-5">
            <!-- Material form subscription -->
            <div class="card">

                <h5 class="card-header unique-color white-text text-center py-4">
                    <strong>Iniciar Seccion</strong>
                </h5>

                <!--Card content-->
                <div class="card-body px-lg-5">

                    <!-- Form -->
                    <form class="text-center" style="color: #757575;" action="frmlogin.php" method="POST">

                        <p>Ingresa para ver los productos en linea y las ventas.</p>

                        <p>
                            <a href="frmregistrocliente.php" target="_blank">No tines login ingresa aqui!!</a>
                        </p>

                        <!-- Name -->
                        <div class="md-form mt-3">
                            <input type="text" class="form-control" id="txtLogin" name="txtLogin" value="<?php echo $login ?>">
                            <label for="materialSubscriptionFormPasswords">Usuario</label>
                        </div>

                        <!-- E-mai -->
                        <div class="md-form">
                            <input type="password" class="form-control" id="txtPassword" name="txtPassword" value="<?php echo $password ?>">
                            <label for="materialSubscriptionFormEmail">Password</label>
                        </div>

                        <!-- Sign in button -->
                        <button class="btn btn-mdb-color btn-block" type="submit" name="btnAceptar" value="Aceptar">Ingresar</button>
                        <br>
                        <button class="btn btn-mdb-color btn-block" type="submit" name="btnCancelar" value="Cancelar">Cancelar</button>

                    </form>
                    <br>
                    <!--si la varible errores no esta vacia-->
                    <?php if (!empty($error)) : ?>
                        <div class="alert alert-danger" role="alert">
                            <?php echo $error; ?>
                        </div>
                    <?php endif ?>
                    <!-- Form -->

                </div>

            </div>
            <!-- Material form subscription -->



        </div>
    </div>
    <?php include("incluir_estilos_pie.php"); ?>
</body>

</html>