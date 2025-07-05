<!--autor: Jonathan Alejandro Baquerizo-->

<?php
    require_once 'config/Conexion.php';
    class ServiciosDAO {

        private $con;

        public function __construct() {
            $this->con = Conexion::getConexion();
        }
        public function selectAll($parametro){
        try{
            $sql = "select * from registroservicio where (nombre LIKE :n1 or marcaVehiculo LIKE :b1 or placaVehiculo LIKE :b2)" ;
            //prepare statement 
            $stmt = $this->con->prepare($sql);
            $busqueda = "%".$parametro."%"; // para buscar considencias tanto al un inicio como al final
            //enviar parametros a la sentencia 
            $stmt->bindparam(":n1", $busqueda, PDO::PARAM_STR);
            $stmt->bindparam(":b1", $busqueda, PDO::PARAM_STR);
            $stmt->bindparam(":b2", $busqueda, PDO::PARAM_STR);
            //ejecutamos la sentencia
            $stmt->execute();
            //recuperación (fetch) de resultados 
            $res = $stmt->fetchAll(PDO::FETCH_ASSOC); //fetchAll recupera todos los resultados retornandolos en el formato que especifiquemos
            // FETCH_ASSOC: retorna cada registri(fila) de la tabla como un arreglo asociativo
            // FECH_ALL: retorna todos los registros de la tabla como un arreglo asociativo
            return $res;  
         
        }catch(PDOEXception $er){
            error_log("Error en selectAll de ServiciosDAO ". $er->getMessage());
            return null;
        }

     
    }

    public function selectAllforId($parametro){
        try{
            $sql = "select * from registroservicio where id_user=:parametro AND statusLogical=1" ;
            //prepare statement 
            $stmt = $this->con->prepare($sql);
            $busqueda = "%".$parametro."%"; // para buscar considencias tanto al un inicio como al final
            //enviar parametros a la sentencia 
            $stmt->bindparam(":parametro", $parametro, PDO::PARAM_STR);
            //ejecutamos la sentencia
            $stmt->execute();
            //recuperación (fetch) de resultados 
            $res = $stmt->fetchAll(PDO::FETCH_ASSOC); //fetchAll recupera todos los resultados retornandolos en el formato que especifiquemos
            // FETCH_ASSOC: retorna cada registri(fila) de la tabla como un arreglo asociativo
            // FECH_ALL: retorna todos los registros de la tabla como un arreglo asociativo
            return $res;  
         
        }catch(PDOEXception $er){
            error_log("Error en selectAllForId de ServiciosDAO ". $er->getMessage());
            return null;
        }

     
    }

    public function selectOne($id){
        try{
           $sql="select * from registroservicio where id_Registro=:id";
           $stmt = $this->con->prepare($sql);
           $stmt->bindParam(":id",$id, PDO::PARAM_INT);
           $stmt->execute();
           $res= $stmt->fetch(PDO::FETCH_ASSOC);
           //feth retorna un solo elemento, en este caso como usamos FETCH_ASSOC retorna un arreglo asociativo
           // que representa a una unica fila en la base de datos
           return $res;
        }catch(PDOEXception $er){
            error_log("Error en selectOne de ServicioDAO ". $er->getMessage());
            return null;
        }
    }

    public function insert($servicio){
        try{
           $sql="insert into registroServicio (nombre, cedula, telefono, correo, marcaVehiculo, placaVehiculo, tipoServicio
           , fechaCreacion ) values (:nombre, :cedula, :telefono, :correo, :marcaVehiculo,:placaVehiculo, :tipoServicio ,:fecha)";
          $stmt = $this->con->prepare($sql);
          $stmt->bindParam(":nombre",$servicio->getNombre(), PDO::PARAM_STR);
          $stmt->bindParam(":cedula",$servicio->getCedula(), PDO::PARAM_STR);
          $stmt->bindParam(":telefono",$servicio->getTelefono(), PDO::PARAM_STR);
          $stmt->bindParam(":correo",$servicio->getCorreo(), PDO::PARAM_STR);
          $stmt->bindParam(":marcaVehiculo",$servicio->getmarcaVehiculo(), PDO::PARAM_STR);
          $stmt->bindParam(":placaVehiculo",$servicio->getplacaVehiculo(), PDO::PARAM_STR);
          $stmt->bindParam(":tipoServicio",$servicio->getTipoServicio(), PDO::PARAM_STR);
          $stmt->bindParam(":fecha",$servicio->getfechaCreacion(), PDO::PARAM_STR);


         $res= $stmt->execute(); 
         return $res;
        }catch(PDOEXception $er){
            error_log("Error en insert de ServiciosDAO ". $er->getMessage());
            return false;
        }
    }

    public function update($servicio){
         try{
           $sql="update registroServicio set nombre=:nombre, cedula=:cedula, telefono=:telefono, correo=:correo, 
           marcaVehiculo=:marcaVehiculo, placaVehiculo=:placaVehiculo, 
           fechaModificacion=:fechaMod where id_Registro=:id";
          $stmt = $this->con->prepare($sql);
          $stmt->bindParam(":nombre",$servicio->getNombre(), PDO::PARAM_STR);
          $stmt->bindParam(":cedula",$servicio->getCedula(), PDO::PARAM_STR);
          $stmt->bindParam(":telefono",$servicio->getTelefono(), PDO::PARAM_STR);
          $stmt->bindParam(":correo",$servicio->getCorreo(), PDO::PARAM_STR);
          $stmt->bindParam(":marcaVehiculo",$servicio->getmarcaVehiculo(), PDO::PARAM_STR);
          $stmt->bindParam(":placaVehiculo",$servicio->getplacaVehiculo(), PDO::PARAM_STR);
          $stmt->bindParam(":fechaMod",$servicio->getfechaModificacion(), PDO::PARAM_STR);
          $stmt->bindParam(":id",$servicio->getId(), PDO::PARAM_INT);

         $res= $stmt->execute(); // execute retorna true si tuvo exito la ejecucion, false en caso contrario
         return $res;
        }catch(PDOEXception $er){
            error_log("Error en update de ServiciosDAO ". $er->getMessage());
            return false;
        }
    }

    public function logicalDelete($id){
        try{
           $sql="update registroservicio set statusLogical=0 where id_Registro=:id";
          $stmt = $this->con->prepare($sql);
           $stmt->bindParam(":id",$id, PDO::PARAM_INT);

         $res= $stmt->execute(); // execute retorna true si tuvo exito la ejecucion, false en caso contrario
         return $res;
        }catch(PDOEXception $er){
            error_log("Error en logicalDelete de ServiciosDAO ". $er->getMessage());
            return false;
            }
        }
    }


?>