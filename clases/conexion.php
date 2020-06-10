<?php
namespace clases\conexion;
class Conexion
{
    private $servidor = "localhost";
    private $usuario = "root";
    private $password = "";
    private $basededatos = "proyecto";
    public $cnx;
    public function __construct()
    {
        $this->cnx = mysqli_connect($this->servidor,$this->usuario,$this->password,$this->basededatos);

    }
    public function execute($sql)
    {
        return mysqli_query($this->cnx,$sql);
    }
    public function ultimo_id()
    {
        return @mysqli_insert_id($this->cnx);
    }
    public function filas_afectadas()
    {
        return @mysqli_affected_rows($this->cnx);
    }
    public function close()
    {
        return @mysqli_close($this->cnx);
    }
    public function next($resultadosql)
    {
        return mysqli_fetch_array($resultadosql);
        //return mysqli_fetch_object($resultadosql);
    }
    public function validar_caracteres($cadena)
    {
        return mysqli_real_escape_string($this->cnx,$cadena);
    }


}


?>