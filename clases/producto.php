<?php

namespace clases\producto;

class Producto
{
    private $id;
    private $categoria_id;
    private $nombre;
    private $marca;
    private $descripcion;
    private $precio;
    private $cantidad;
    private $imagen;

    private $cnx;

    function inicializar($id, $categoria_id, $nombre, $marca, $descripcion, $precio, $cantidad, $imagen)
    {
        $this->id = $id;
        $this->categoria_id = $categoria_id;
        $this->nombre = $nombre;
        $this->marca = $marca;
        $this->descripcion = $descripcion;
        $this->precio = $precio;
        $this->cantidad = $cantidad;
        $this->imagen = $imagen;
    }
    function __construct($cnx)
    {
        $this->id = 0;
        $this->categoria_id = 0;
        $this->nombre = "";
        $this->marca = "";
        $this->descripcion = "";
        $this->precio = 0;
        $this->cantidad = 0;
        $this->imagen = "";
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

    public function getCategoria_id()
    {
        return $this->categoria_id;
    }
    public function setCategoria_id($categoria_id)
    {
        $this->categoria_id = $categoria_id;
    }

    function set_nombre($nombre)
    {
        $this->nombre = $nombre;
    }
    function get_nombre()
    {
        return $this->nombre;
    }

    function set_marca($marca)
    {
        $this->marca = $marca;
    }
    function get_marca()
    {
        return $this->nombre;
    }

    function set_descripcion($descripcion)
    {
        $this->descripcion = $descripcion;
    }
    function get_descripcion()
    {
        return $this->descripcion;
    }


    function set_precio($precio)
    {
        $this->precio = $precio;
    }
    function get_precio()
    {
        return $this->precio;
    }
    function set_cantidad($cantidad)
    {
        $this->cantidad = $cantidad;
    }
    function get_cantidad()
    {
        return $this->cantidad;
    }


    function set_imagen($imagen)
    {
        $this->imagen = $imagen;
    }
    function get_imagen()
    {
        return $this->imagen;
    }

    function guardar()
    {
        $cat = $this->categoria_id;
        $n = $this->nombre;
        $m = $this->marca;
        $d = $this->descripcion;
        $p = $this->precio;
        $c = $this->cantidad;
        $i = $this->imagen;


        $sql = "insert into productos values(null,$cat,'$n','$m','$d',$p,$c,'$i')";
        $resultado = $this->cnx->execute($sql);
        if (isset($resultado) && $this->cnx->filas_afectadas() > 0) {
            return true;
        } else {
            return false;
        }
    }
    function modificar()
    {
        $cat = $this->categoria_id;
        $n = $this->nombre;
        $m = $this->marca;
        $d = $this->descripcion;
        $p = $this->precio;
        $c = $this->cantidad;
        $i = $this->imagen;
        $id = $this->id;

        $sql = "update productos set categoria_id=$cat,nombre = '$n',marca='$m',descripcion='$d', precio = $p,cantidad = $c, imagen ='$i' where id = $id";
        $resultado = $this->cnx->execute($sql);
        if (isset($resultado) && $this->cnx->filas_afectadas() > 0) {
            return true;
        } else {
            return false;
        }
    }
    function eliminar()
    {
        $id = $this->id;
        $sql = "delete from productos where id = $id";
        $resultado = $this->cnx->execute($sql);
        if (isset($resultado) && $this->cnx->filas_afectadas() > 0) {
            return true;
        } else {
            return false;
        }
    }
    function buscar($criterionombre)
    {
        //$id = $this->id;
        $sql = "select * from productos where nombre like '%$criterionombre%' ";
        $resultado = $this->cnx->execute($sql);
        if (isset($resultado) && $this->cnx->filas_afectadas() > 0) {
            return $resultado;
        } else {
            return false;
        }
    }
    function traerporid($id)
    {
        //$id = $this->id;
        $sql = "select * from productos where id = $id";
        $resultado = $this->cnx->execute($sql);
        if (isset($resultado) && $this->cnx->filas_afectadas() > 0) {
            $registro = $this->cnx->next($resultado);
            $this->id = $id;
            $this->categoria_id = $registro["categoria_id"];
            $this->nombre = $registro["nombre"];
            $this->marca = $registro["marca"];
            $this->descripcion = $registro["descripcion"];
            $this->precio = $registro["precio"];
            $this->cantidad = $registro["cantidad"];
            $this->imagen = $registro["imagen"];
            return true;
        } else {
            return false;
        }
    }

    /* -******************************************** */




    function buscarabm($criterionombre, $paginadestino)
    {
        //$id = $this->id;
        $sql = "select * from productos where nombre like '%$criterionombre%' ";
        $resultado = $this->cnx->execute($sql);
        if (isset($resultado) && $this->cnx->filas_afectadas() > 0) {
            echo "<table class='table table-striped'>";
            echo "<tr class='thead-dark'>
            <th scope='col'>Id.</th>
            <th scope='col'>Nombre</th>
            <th scope='col'>Precio $.</th>
            <th scope='col'>Categoria</th>
            <th scope='col'>Cantidad</th>
            <th scope='col'>Imgen</th>
            <th scope='col'>Mod.</th><th>Elim.</th>";
            while ($registro = $this->cnx->next($resultado)) {
                $id = $registro["id"];
                $n = $registro["nombre"];
                $p = $registro["precio"];
                $cat = $registro["categoria_id"];
                $c = $registro["cantidad"];
                $im = $registro["imagen"];
                $linkmodificar = "<a class='btn btn-outline-success' href='$paginadestino?id=$id&op=2' role='button'><i class='fas fa-pen pr-2 'aria-hidden='true'></i>Modificar</a>";
                $linkeliminar = "<a class='btn btn-outline-danger' href='$paginadestino?id=$id&op=3' role='button'><i class='fas fa-trash-alt pr-2 'aria-hidden='true'></i>Eliminar</a>";

                echo "<tr>
                <th scope='row'>$id</th>
                <td>$n</td>
                <td>$p</td>
                <td>$cat</td>
                <td>$c</td>
                <td> <img   width='60' height='60' class='card-img-top 'src='$im'></td>
                <td>$linkmodificar</th>
                <th>$linkeliminar</th>";
            }
            echo "</table>";
        } else {
            return false;
        }
    }
    /* ****************************************************** */
    function obtenercategoria()
    {
        $sql = "select * from categorias";
        $resultado = $this->cnx->execute($sql);
        if (isset($resultado) && $this->cnx->filas_afectadas() > 0) {
            echo "<select name='txtselect' class='form-control'>";
            while ($registro = $this->cnx->next($resultado)) {
                $id = $registro["id"];
                $n = $registro["nombre"];

                echo "<option value='$id'>$n</option>";
            }
            echo "</select>";
        } else {
            return false;
        }
    }
    /*********************************************************************************************************************/

    public function buscar_producto_seleccion($criterionombre, $paginadestino)
    {

        //$id = $this->id;
        $sql = "select * from productos where nombre like '%$criterionombre%' ";
        $resultado = $this->cnx->execute($sql);
        //para evitar errores en la consulta
        //me aseguro que el resultado no sea nulo
        //y que la cantidad de filas afectadas sea mayour a cero
        if (isset($resultado) && $this->cnx->filas_afectadas() > 0) {
            /* echo "<table class='table table-striped'>";
              echo "<thead>
                      <tr class='thead-dark'>
                          <th scope='col'>#</th>
                          <th scope='col'>Id.</th>
                          <th scope='col'>Nombre</th>
                          <th scope='col'>Precio bs.</th>
                          <th scope='col'>Cantidad</th>
                          <th scope='col'>Adicionar al carrito</th>
                      </tr>
                  </thead>
                  <tbody>"; */
            $nro = 1;

            while ($registro = $this->cnx->next($resultado)) {
                $id = $registro["id"];
                $nombre = $registro["nombre"];
                $marca = $registro["marca"];
                $descripcion = $registro["descripcion"];
                $precio = $registro["precio"];
                $cantidad = $registro["cantidad"];
                $imagen = $registro["imagen"];
                // $linkseleccionar = "<a class='btn btn-outline-success' href='$paginadestino?id=$id&op=4'>Adicionar al carrito</a>";
                $linkseleccionar = " 
                  <button type='button' 
                  class='btn aqua-gradient'
                 data-toggle='modal'
                 data-id='$id' 
                 data-nombre='$nombre' 
                 data-precio='$precio' 
                 data-cantidad='$cantidad' 
                 data-target='#exampleModal' 
                 data-whatever='@mdo'>
                 <i class='fas fa-shopping-cart pr-2' aria-hidden='true'></i>
                 Adicionar
                 </button>";
                /*   echo "<tr>
                      <th scope='row'>$nro</th>
                      <td>$id</td>
                      <td>$nombre</td>
                      <td>$precio</td>
                      <td>$cantidad</td>
                      <td>$linkseleccionar</td>
                     
                      </tr>"; */

                echo " <div class='col-3'>";
                echo " <div class='card'>";
                echo " <img title='$nombre' alt='$nombre' height='300px' class='card-img-top 'src='$imagen'>";
                echo "<div class='card-body'>";
                echo " <span  class='font-weight-bold'>$nombre <br>$precio $.</span>";
                echo "<h6 class='font-italic'> $descripcion</h6>";
                echo "<p class='card-text'>Disponible: $cantidad <br> $marca</p>";
                echo  $linkseleccionar;
                echo  "</div>";
                echo  "</div>";
                echo "</div>";

                $nro++;
            }
            echo "</tbody>
              </table>";
        } else {
            return false;
        }
    }
}
