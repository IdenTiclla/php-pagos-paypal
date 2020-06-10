<?php
namespace clases\cliente;  
  class Cliente
  {
      private $id;
      private $nombre;
      private $email;
      private $direccion;
      private $login;
      private $password;
      private $telefono;

      private $cnx;


      function inicializar($id,$nombre,$email,$direccion,$login,$password,$telefono)
      {
          $this->id = $id;
          $this->nombre = $nombre;
          $this->email = $email;
          $this->direccion = $direccion;
          $this->login= $login;
          $this->password = $password;
          $this->telefono = $telefono;
          
      }
      function __construct($cnx)
      {
            $this->id = 0;
            $this->nombre = "";
            $this->email = "";
            $this->direccion = "";
            $this->login="";
            $this->password = "";
            $this->telefono = "";
            $this->cnx = $cnx;
      }

/*********************************************** */
      function set_id($id)
      {
          $this->id = $id;
      }
      function get_id()
      {
          return $this->id;
      }
      /***********************************/
      function set_nombre($nombre)
      {
          $this->nombre = $nombre;
      }
      function get_nombre()
      {
          return $this->nombre;
      }
       /***********************************/
       function set_email($email)
       {
           $this->email = $email;
       }
       function get_email()
       {
           return $this->email;
       }
       /*******************************/
      function set_direccion($direccion)
      {
          $this->direccion = $direccion;
      }
      function get_direccion()
      {
          return $this->direccion;
      }
       /***********************************/
       function set_login($login)
      {
          $this->login = $login;
      }
      function get_login()
      {
          return $this->login;
      }
       /***********************************/
       function set_password($password)
       {
           $this->login = $password;
       }
       function get_password()
       {
           return $this->password;
       }
        /***********************************/

      function set_telefono($telefono)
      {
          $this->telefono = $telefono;
      }
      function get_telefono()
      {
          return $this->telefono;
      }
       /***********************************/


       function guardar()
    {     
      
      $nombre= $this->nombre;
      $email=$this->email;
      $direccion=$this->direccion;
      $login=$this->login;
      $password=$this->password;
      $telefono=$this->telefono;

        $sql = "insert into clientes values(null,'$nombre','$email','$direccion','$login',md5('$password'),'$telefono')";
        $resultado = $this->cnx->execute($sql);    
        if(isset($resultado)&&$this->cnx->filas_afectadas()>0)
        {  
           return true;
        }
        else
        {
           return false;
        }
    }

    function modificar()
    { 
      $id =$this->id;
      $nombre= $this->nombre;
      $email=$this->email;
      $direccion=$this->direccion;
      $login=$this->login;
      $password=$this->password;
      $telefono=$this->telefono;

        $sql = "update clientes set nombre = '$nombre', email = '$email', direccion ='$direccion', login= '$login', password='$password', telefono='$telefono' where id = $id";
        $resultado = $this->cnx->execute($sql);    
        if(isset($resultado)&&$this->cnx->filas_afectadas()>0)
        {  
           return true;
        }
        else
        {
           return false;
        }
    }
    function eliminar()
    {     
        $id = $this->id;
        $sql = "delete from clientes where id = $id";
        $resultado = $this->cnx->execute($sql);    
        if(isset($resultado)&&$this->cnx->filas_afectadas()>0)
        {  
           return true;
        }
        else
        {
           return false;
        }
    }
    function buscar($criterionombre)
    {     
        //$id = $this->id;
        $sql = "select * from clientes where nombre like '%$criterionombre%' ";
        $resultado = $this->cnx->execute($sql);    
        if(isset($resultado)&&$this->cnx->filas_afectadas()>0)
        {  
           return $resultado;
        }
        else
        {
           return false;
        }
    }


    function traerporid($id)
    {     
        //$id = $this->id;
        $sql = "select * from clientes where id = $id";
        $resultado = $this->cnx->execute($sql);    
        if(isset($resultado)&&$this->cnx->filas_afectadas()>0)
        {  
           $registro = $this->cnx->next($resultado);
           $this->id = $id;
           $this->nombre = $registro["nombre"];
           $this->email=$registro['email'];
           $this->direccion=$registro['direccion'];
           $this->login=$registro['login'];
           $this->password=$registro['password'];
           $this->telefono=$registro['telefono'];

           return true;
        }
        else
        {
           return false;
        }
    }

    function loguear($login,$password)
    {
        //$id = $this->id;
        $sql = "select * from clientes where login = '$login' and password = MD5('$password') ";
        $resultado = $this->cnx->execute($sql);
        //para evitar errores en la consulta
        //me aseguro que el resultado no sea nulo
        //y que la cantidad de filas afectadas sea mayour a cero
        if (isset($resultado) && $this->cnx->filas_afectadas() > 0) {
            //cada vez que se hace una consulta el apuntador apunta a un registro nulo
            //se debe apuntar al siguiente registro para obtener el primer registro de una consulta
            $registro = $this->cnx->next($resultado);
            $this->id = $registro["id"];
            $this->nombre = $registro["nombre"];
            $this->email = $registro["email"];
            $this->direccion = $registro["direccion"];
            $this->login = $registro["login"];
            $this->telefono = $registro["telefono"];
            return true;
        } else {
            return false;
        }
    }




    function buscarabm($criterionombre,$paginadestino)
    {     
        //$id = $this->id;
        $sql = "select * from clientes where nombre like '%$criterionombre%' ";
        $resultado = $this->cnx->execute($sql);    
        if(isset($resultado)&&$this->cnx->filas_afectadas()>0)
        {  
            echo "<table  class='table table-striped table-hover'>";
            echo "<tr class='thead-dark'>
            <th scope='col'>Id.</th>
            <th scope='col'>Nombre</th>
            <th scope='col'>Email</th>
            <th scope='col'>direccion</th>
            <th scope='col'>login</th>
            <th scope='col'>password</th>
            <th scope='col'>telefono</th>
            <th scope='col'>Mod.</th>
            <th scope='col'>Elim.</th>";
            while($registro = $this->cnx->next($resultado))
            {
                  $id = $registro["id"];
                  $nombre=$registro['nombre'];
                  $email=$registro['email'];
                  $direccion=$registro['direccion'];
                  $login=$registro['login'];
                  $password=$registro['password'];
                  $telefono=$registro['telefono'];
            
                $linkmodificar = "<a class='btn btn-outline-success' href='$paginadestino?id=$id&op=2' role='button'><i class='fas fa-user-edit pr-2 'aria-hidden='true'></i>Modificar</a>";
                $linkeliminar = "<a class='btn btn-outline-danger' href='$paginadestino?id=$id&op=3' role='button'><i class='fas fa-user-times pr-2 'aria-hidden='true'></i>Eliminar</a>";
                
                echo "<tr>
                <th scope='row'>$id</th>
                <td>$nombre</td>
                <td>$email</td>
                <td>$direccion</td>
                <td>$login</td>
                <td>$password</td>
                <td>$telefono</td>
                <td>$linkmodificar</th><th>$linkeliminar</th>";
                
            }
            echo "</table>";
        }
        else
        {
           return false;
        }
    }

 /************************* */
  }
?>
