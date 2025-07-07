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

    public function selectAllItems(){
        try{
            $sql = "select * from registroservicio where statusLogical=1" ;
            //prepare statement 
            $stmt = $this->con->prepare($sql);
            $stmt->execute();
            $res = $stmt->fetchAll(PDO::FETCH_ASSOC); 
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
           , fechaCreacion, id_user ) values (:nombre, :cedula, :telefono, :correo, :marcaVehiculo,:placaVehiculo, :tipoServicio ,:fecha, :id_user)";
          $stmt = $this->con->prepare($sql);
          $stmt->bindParam(":nombre",$servicio->getNombre(), PDO::PARAM_STR);
          $stmt->bindParam(":cedula",$servicio->getCedula(), PDO::PARAM_STR);
          $stmt->bindParam(":telefono",$servicio->getTelefono(), PDO::PARAM_STR);
          $stmt->bindParam(":correo",$servicio->getCorreo(), PDO::PARAM_STR);
          $stmt->bindParam(":marcaVehiculo",$servicio->getmarcaVehiculo(), PDO::PARAM_STR);
          $stmt->bindParam(":placaVehiculo",$servicio->getplacaVehiculo(), PDO::PARAM_STR);
          $stmt->bindParam(":tipoServicio",$servicio->getTipoServicio(), PDO::PARAM_STR);
          $stmt->bindParam(":id_user",$servicio->getId_user(), PDO::PARAM_INT);
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
           fechaModificacion=:fechaMod, id_user=:id_user where id_Registro=:id";
          $stmt = $this->con->prepare($sql);
          $stmt->bindParam(":nombre",$servicio->getNombre(), PDO::PARAM_STR);
          $stmt->bindParam(":cedula",$servicio->getCedula(), PDO::PARAM_STR);
          $stmt->bindParam(":telefono",$servicio->getTelefono(), PDO::PARAM_STR);
          $stmt->bindParam(":correo",$servicio->getCorreo(), PDO::PARAM_STR);
          $stmt->bindParam(":marcaVehiculo",$servicio->getmarcaVehiculo(), PDO::PARAM_STR);
          $stmt->bindParam(":placaVehiculo",$servicio->getplacaVehiculo(), PDO::PARAM_STR);
          $stmt->bindParam(":fechaMod",$servicio->getfechaModificacion(), PDO::PARAM_STR);
          $stmt->bindParam(":id",$servicio->getId(), PDO::PARAM_INT);
          $stmt->bindParam(":id_user",$servicio->getId_user(), PDO::PARAM_INT);

         $res= $stmt->execute(); // execute retorna true si tuvo exito la ejecucion, false en caso contrario
         return $res;
        }catch(PDOEXception $er){
            error_log("Error en update de ServiciosDAO ". $er->getMessage());
            return false;
        }
    }

    public function updateTec($servicio){
         try{
        //    $sql="update registroServicio set fechaModificacion=:fechaMod, id_tecnico=:id_tec,tipoServicio=:typeSer
        //    , estado=:estado where id_Registro=:id";
        $sql="update registroServicio set fechaModificacion=:fechaMod, tipoServicio=:typeSer, estado=:estado, id_tecnico=:id_tecnico where id_Registro=:id";
          $stmt = $this->con->prepare($sql);
          $stmt->bindParam(":typeSer",$servicio->getTipoServicio(), PDO::PARAM_STR);
          $stmt->bindParam(":estado",$servicio->getEstado(), PDO::PARAM_STR);
        $stmt->bindParam(":id_tecnico",$servicio->getId_tecnico(), PDO::PARAM_INT);
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