<?php
 include_once("../clases/ctrl_session.php");
 //---------- USES DE LAS CLASES DE NAMESPACES ----
use \clases\ctrl_session\Ctrl_Session;
//-----------------------------------------------
 //$session = new Ctrl_Session();
 //$session->cerrar_session();
 Ctrl_Session::cerrar_session();
?>