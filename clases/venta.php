<?php
namespace clases\venta;
class Venta
{
    private $id;
    private $fecha;
    private $cliente_id;
    private $estado;

    //atributo para la conexion
    private $cnx;

    //método constructor
    function inicializar($id, $fecha, $cliente_id, $estado)
    {
        $this->id = $id;
        $this->fecha = $fecha;
        $this->cliente_id = $cliente_id;
        $this->estado = $estado;
    }
    function __construct($cnx)
    {
        $this->id = 0;
        $this->fecha = "";
        $this->cliente_id = 0;
        $this->estado = 0;
        $this->cnx = $cnx;
    }
    function set_id($id)
    {
        $this->id = $id;
    }
    function get_id()
    {
        return $this->id;
    }
    function set_estado($estado)
    {
        $this->estado = $estado;
    }
    function get_estado()
    {
        return $this->estado;
    }
    function set_cliente_id($cliente_id)
    {
        $this->cliente_id = $cliente_id;
    }
    function get_cliente_id()
    {
        return $this->cliente_id;
    }
    function set_fecha($fecha)
    {
        $this->fecha = $fecha;
    }
    function get_fecha()
    {
        return $this->fecha;
    }

    function guardar()
    {
        $cliente_id = $this->cliente_id;
        $fecha = $this->fecha;
        $estado = $this->estado;

        $sql = "insert into ventas values(null,'$fecha',$cliente_id,'$estado')";
        $resultado = $this->cnx->execute($sql);

        if (isset($resultado) && $this->cnx->filas_afectadas() > 0) {
            return true;
        } else {
            return false;
        }
    }

    /******************************************************/
    public function mostrarVentasPorCliente($idCliente,$nombrereporte)
    {
        //$id = $this->id;
        $sql = "select * from ventas where cliente_id = $idCliente";
        $resultado = $this->cnx->execute($sql);
        //para evitar errores en la consulta
        //me aseguro que el resultado no sea nulo
        //y que la cantidad de filas afectadas sea mayour a cero
        if (isset($resultado) && $this->cnx->filas_afectadas() > 0) {
            echo "<table class='table table-striped table-dark'>";
            echo "
            <thead>
                 <tr>
                    <th scope='col'>#</th>
                    <th scope='col'>Id.</th>
                    <th scope='col'>fecha</th>
                    <th scope='col'>estado</th>
                    <th scope='col'>Ver reporte</th>
                    
                </tr>
            </thead>
            <tbody>
            ";
            $nro = 1;
            while ($registro = $this->cnx->next($resultado)) {
                $id = $registro["id"];
                $fecha = $registro["fecha"];
                $estado = $registro["estado"];
               
                //$linkseleccionar = "<a href='$paginadestino?id=$id&op=4'>Adicionar al carrito</a>";              
                $linkseleccionar = "
                    <a class='btn btn-primary' href='$nombrereporte?id=$id' target='_blank'>
                        Ver reporte
                    </a>
                ";
                echo "
                    <tr>
                        <th scope='col'>$nro</th>
                        <th scope='col'>$id</th>
                        <th scope='col'>$fecha</th>
                        <th scope='col'>$estado</th>
                        
                        <th scope='col'>$linkseleccionar</th>
                    </tr>
                ";
                $nro++;
            }
            echo "
              </tbody>
            </table>";

        } else {
            return false;
        }
       
    }

}
?>
