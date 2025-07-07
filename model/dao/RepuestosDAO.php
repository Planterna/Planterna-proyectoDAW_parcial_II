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
?>