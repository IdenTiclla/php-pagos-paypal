<?php
namespace clases\ctrl_venta;

use Exception;

class Ctrl_Venta
{
    public static function guardar_venta($cnx,$objventa,$carrito)
    {
        try
        {
            $cnx->execute("start transaction");
            if($objventa->guardar()==false)
            {
                $cnx->execute("rollback");
                return 0;
            }
            else
            {
                $id_venta_guardada = $cnx->ultimo_id();
                //guardo la venta correctamente
                foreach($carrito->list as $item)
                {
                    $item->setVenta_id($id_venta_guardada);
                    $item->setCnx($cnx);
                    if($item->guardar()==false)
                    {
                        $cnx->execute("rollback");
                        return 0;
                    }
                }
                $cnx->execute("commit");
                return $id_venta_guardada;
            }
        }
        catch(Exception $E)
        {
            $cnx->execute("rollback");
            return 0;
        }
    }
}
?>