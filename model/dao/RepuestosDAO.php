<<<<<<< HEAD
<?php
    require_once 'config/Conexion.php';

class RepuestosDAO{
    private $conx;

    public function __construct(){
        $this->conx = conexion::getConexion();
    }
    
    public function selectOne($id){
        try{
            $sql = "SELECT * FROM repuestos WHERE rep_id = :id";
            $stmt = $this->conx->prepare($sql);
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            $stmt->execute();
            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
            return $resultado;
        }catch(PDOException $ex){
            error_log("Error en SelectOne RepuestoDAO: " ) . $ex->getMessage();
            return null;
        }
    }

        public function selectAll($parametro){
        try{
            $sql = "SELECT repuestos.*, marcas.mar_nombre, modelos.mod_nombre
                    FROM repuestos, marcas, modelos 
                    WHERE repuestos.rep_idMarca = marcas.mar_id
                    AND repuestos.rep_idModelo = modelos.mod_id
                    AND (repuestos.rep_nombre LIKE :b1 
                    OR marcas.mar_nombre LIKE :b2 
                    OR modelos.mod_nombre LIKE :b3)";
            $stmt = $this->conx->prepare($sql);
            $parametro = "%".$parametro."%";

            $stmt->bindParam(":b1", $parametro, PDO::PARAM_STR);
            $stmt->bindParam(":b2", $parametro,PDO::PARAM_STR);
            $stmt->bindParam(":b3", $parametro, PDO::PARAM_STR);

            $stmt->execute();
            $res = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $res;
        }catch(PDOException $ex){
            error_log("Error en selectAll RepuestoDAO: ") . $ex->getMessage();
            return null;
        }
    }

    public function insert($repuesto){
        try{
            $sql = "INSERT INTO Repuestos (rep_nombre, rep_descripcion, rep_precio, rep_stock, rep_tipoRepuesto, rep_idMarca, rep_idModelo, rep_estado)
                    VALUES(:b1, :b2, :b3, :b4, :b5, :b6, :b7, :b8)";
            $stmt = $this->conx->prepare($sql);
            $stmt->bindParam(":b1", $repuesto->getNombre(), PDO::PARAM_STR);
            $stmt->bindParam(":b2", $repuesto->getDescripcion(), PDO::PARAM_STR);
            $stmt->bindParam(":b3", $repuesto->getPrecio(), PDO::PARAM_STR);
            $stmt->bindParam(":b4", $repuesto->getStock(), PDO::PARAM_INT);
            $stmt->bindParam(":b5", $repuesto->getTipoRepuesto(), PDO::PARAM_STR);
            $stmt->bindParam(":b6", $repuesto->getIdMarca(), PDO::PARAM_INT);
            $stmt->bindParam(":b7", $repuesto->getIdModelo(), PDO::PARAM_INT);
            $stmt->bindParam(":b8", $repuesto->getEstado(),PDO::PARAM_INT);
            return $stmt->execute();
        }catch(PDOException $ex){
            error_log("Error en insert RepuestoDAO: " . $ex->getMessage());
            return false;
        }
    }

    public function update($repuesto){
        try{
            $sql = "UPDATE repuestos SET
                    rep_nombre = :b1,
                    rep_descripcion = :b2,
                    rep_precio = :b3,
                    rep_stock = :b4,
                    rep_tipoRepuesto = :b5,
                    rep_idMarca = :b6,
                    rep_idModelo = :b7,
                    rep_estado = :b8
                    WHERE rep_id = :id";

            $stmt = $this->conx->prepare($sql);
            $stmt->bindParam(":b1", $repuesto->getNombre() ,PDO::PARAM_STR);
            $stmt->bindParam(":b2", $repuesto->getDescripcion(), PDO::PARAM_STR);   
            $stmt->bindParam(":b3", $repuesto->getPrecio(), PDO::PARAM_STR);
            $stmt->bindParam(":b4", $repuesto->getStock(), PDO::PARAM_INT);
            $stmt->bindParam(":b5", $repuesto->getTipoRepuesto(), PDO::PARAM_STR);
            $stmt->bindParam(":b6", $repuesto->getIdMarca(), PDO::PARAM_STR);
            $stmt->bindParam(":b7", $repuesto->getIdModelo(), PDO::PARAM_STR);
            $stmt->bindParam(":b8", $repuesto->getEstado(), PDO::PARAM_STR);
            return $stmt->execute();
        }catch(PDOException $ex){
            error_log("Error en update RepuestoDAO: ") . $ex->getMessage();
            return false;
        }
    }

    public function delete($id){
        try{
            $sql = "DELETE FROM repuestos WHERE rep_id = :id";

            $stmt = $this->conx->prepare($sql);
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            return $stmt->execute();
        }catch(PDOException $ex){
            error_log("Error en update RepuestoDAO: ") . $ex->getMessage();
            return false;
        }
    }
}
=======
<?php
    require_once 'config/Conexion.php';

class RepuestosDAO{
    private $conx;

    public function __construct(){
        $this->conx = conexion::getConexion();
    }
    
    public function selectOne($id){
        try{
            $sql = "SELECT FROM Repuesto WHERE rep_id = :id";
            $stmt = $this->conx->prepare($sql);
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            $stmt->execute();
            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
            return $resultado;
        }catch(PDOException $ex){
            echo "Error en SelectOne RepuestoDAO: " + $ex->getMessage();
            return null;
        }
    }

    public function selectAll(){
        try{
            $sql = "SELECT FROM * Repuesto";
            $stmt = $this->conx->prepare($sql);
            $stmt->execute();
            $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $resultado;
        }catch(PDOException $ex){
            echo "Error en selectAll RepuestoDAO: " + $ex->getMessage();
            return [];
        }
    }
    public function insert($repuesto){
        try{
            $sql = "INSERT INTO Repuesto (rep_nombre, rep_marca, rep_modelo, rep_precio,
                                rep_stock, rep_fecha_registro, rep_fecha_actualizacion, rep_tipo_repuesto)
                                VALUES(:nombre, :marca, modelo, precio, stock, fecha_registro, fecha_actualizacion,
                                        tipo_repuesto)";
            $stmt = $this->conx->prepare($sql);
            $stmt->bindParam(":nombre", $repuesto->getNombre(), PDO::PARAM_STR);
            $stmt->bindParam(":marca", $repuesto->getMarca(), PDO::PARAM_STR);
            $stmt->bindParam(":modelo", $repuesto->gerModelo(), PDO::PARAM_STR);
            $stmt->bindParam(":precio", $repuesto->getPrecio(), PDO::PARAM_STR);
            $stmt->bindParam(":stock", $repuesto->getStock(), PDO::PARAM_INT);
            $stmt->bindParam(":fecha_registro", $repuesto->getFechaRegistro, PDO::PARAM_STR);
            $stmt->bindParam(":fecha_actualizacion", $repuesto->getFechaActualizacion, PDO::PARAM_STR);
            $stmt->bindParam(":tipo_repuesto", $repuesto->getTipoRepuest, PDO::PARAM_STR);

            return $stmt->execute();
        }catch(PDOException $ex){
            echo "Error en insert RepuestoDAO: " + $ex->getMessage();
            return false;
        }
    }

    public function update($id, $repuesto){
        try{
            $sql = "UPDATE Repuesto SET
                    rep_nombre = :nombre,
                    rep_marca = :marca,
                    rep_modelo = :modelo,
                    rep_precio = :precio,
                    rep_stock = :stock,
                    rep_fecha_registro = :fecha_registro,
                    rep_fecha_actualizacion = :fecha_actualizacion,
                    rep_tipo_repuesto = :tipo_repuesto
                    WHERE rep_id = :id";

            $stmt = $this->conx->prepare($sql);
            $stmt->bindParam(":nombre", $repuesto['rep_nombre'], PDO::PARAM_STR);
            $stmt->bindParam(":marca", $repuesto['rep_marca'], PDO::PARAM_STR);
            $stmt->bindParam(":modelo", $repuesto['rep_modelo'], PDO::PARAM_STR);
            $stmt->bindParam(":precio", $repuesto['rep_precio'], PDO::PARAM_STR);
            $stmt->bindParam(":stock", $repuesto['rep_stock'], PDO::PARAM_INT);
            $stmt->bindParam(":fecha_registro", $repuesto['rep_fecha_registro'], PDO::PARAM_STR);
            $stmt->bindParam(":fecha_actualizacion", $repuesto['rep_fecha_actualizacion'], PDO::PARAM_STR);
            $stmt->bindParam(":tipo_repuesto", $repuesto['rep_tipo_repuesto'], PDO::PARAM_STR);

            return $stmt->execute();
        }catch(PDOException $ex){
            echo "Error en update RepuestoDAO: " + $ex->getMessage();
            return false;
        }
    }

    public function delete($id){
        try{
            $sql = "DELETE FROM Repuesto WHERE rep_id = :id";

            $stmt = $this->conx->prepare($sql);
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            return $stmt->execute();
        }catch(PDOException $ex){
            echo "Error en update RepuestoDAO: " + $ex->getMessage();
            return false;
        }
    }
}
>>>>>>> 40858e616dc5bfcb5344e83b7d8a631c8cd99cfc
?>