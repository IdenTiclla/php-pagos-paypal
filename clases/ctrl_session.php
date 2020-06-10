<?php
namespace clases\ctrl_session;
class Ctrl_Session
{
    private static $login_usuario = "login_usuario";
    private static  $id_usuario="id_usuario";
    private static $nombre_usuario = "nombre_usuario";
    
    public static function  get_nombre_usuario()
    {
        return $_SESSION[Ctrl_Session::$nombre_usuario];
    }
    public static function get_id_usuario()
    {
        return $_SESSION[Ctrl_Session::$id_usuario];
    }
    static function get_login_usuario()
    {
        return $_SESSION[Ctrl_Session::$login_usuario];
    }
    static function activar_session()
    {
        try
        {
            @session_start();
        }
        catch(\Exception $e){

        }
    }
    static function iniciar_session($login,$id_usuario,$nombre_usuario)
    {
        Ctrl_Session::activar_session();
        $_SESSION[Ctrl_Session::$login_usuario]=$login;
        $_SESSION[Ctrl_Session::$id_usuario] = $id_usuario;
        $_SESSION[Ctrl_Session::$nombre_usuario] = $nombre_usuario;
    }
    static function verificar_inicio_session()
    {
        Ctrl_Session::activar_session();
        //siesta logedo
        if(isset($_SESSION[Ctrl_Session::$login_usuario]))
            return true;
        else
           header('location:../frmlogin.php?msg=no esta logueado!!!');
    }
    static function cerrar_session()
    {
        Ctrl_Session::activar_session();
        unset($_SESSION[Ctrl_Session::$login_usuario]);
        unset($_SESSION[Ctrl_Session::$id_usuario]);
        unset($_SESSION[Ctrl_Session::$nombre_usuario]);
        
        
        if(isset($_COOKIE[session_name()])) { 
            setcookie(session_name(), '', time() -65464, '/'); 
        } 
        session_destroy(); 
        header('location:../index.php?msg=no esta logueado!!!');
    }
}
?>