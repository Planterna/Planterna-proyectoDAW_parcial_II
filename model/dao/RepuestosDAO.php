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
?>