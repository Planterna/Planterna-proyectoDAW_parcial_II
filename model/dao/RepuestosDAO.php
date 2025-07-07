<?php
require_once 'config/Conexion.php';

class RepuestosDAO {
    private $conx;

    public function __construct() {
        $this->conx = conexion::getConexion();
    }

    public function selectOne($id) {
        try {
            $sql = "SELECT * FROM Repuesto WHERE rep_id = :id";
            $stmt = $this->conx->prepare($sql);
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            $stmt->execute();
            $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
            return $resultado;
        } catch (PDOException $ex) {
            echo "Error en selectOne RepuestoDAO: " . $ex->getMessage();
            return null;
        }
    }

    public function selectAll() {
        try {
            $sql = "SELECT * FROM Repuesto";
            $stmt = $this->conx->prepare($sql);
            $stmt->execute();
            $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $resultado;
        } catch (PDOException $ex) {
            echo "Error en selectAll RepuestoDAO: " . $ex->getMessage();
            return [];
        }
    }

    public function insert($repuesto) {
        try {
            $sql = "INSERT INTO Repuesto 
                    (rep_nombre, rep_idMarca, rep_idModelo, rep_precio, rep_stock, rep_tipoRepuesto, rep_estado)
                    VALUES 
                    (:nombre, :marca, :modelo, :precio, :stock, :tipoRepuesto, :estado)";
            $stmt = $this->conx->prepare($sql);
            $stmt->bindValue(":nombre", $repuesto->getNombre(), PDO::PARAM_STR);
            $stmt->bindValue(":marca", $repuesto->getIdMarca(), PDO::PARAM_INT);
            $stmt->bindValue(":modelo", $repuesto->getIdModelo(), PDO::PARAM_INT);
            $stmt->bindValue(":precio", $repuesto->getPrecio(), PDO::PARAM_STR);
            $stmt->bindValue(":stock", $repuesto->getStock(), PDO::PARAM_INT);
            $stmt->bindValue(":tipoRepuesto", $repuesto->getTipoRepuesto(), PDO::PARAM_STR);
            $stmt->bindValue(":estado", $repuesto->getEstado(), PDO::PARAM_INT);
            return $stmt->execute();
        } catch (PDOException $ex) {
            echo "Error en insert RepuestoDAO: " . $ex->getMessage();
            return false;
        }
    }

    public function update($repuesto) {
        try {
            $sql = "UPDATE Repuesto SET
                        rep_nombre = :nombre,
                        rep_idMarca = :marca,
                        rep_idModelo = :modelo,
                        rep_precio = :precio,
                        rep_stock = :stock,
                        rep_tipoRepuesto = :tipoRepuesto,
                        rep_estado = :estado
                    WHERE rep_id = :id";
            $stmt = $this->conx->prepare($sql);
            $stmt->bindValue(":id", $repuesto->getId(), PDO::PARAM_INT);
            $stmt->bindValue(":nombre", $repuesto->getNombre(), PDO::PARAM_STR);
            $stmt->bindValue(":marca", $repuesto->getIdMarca(), PDO::PARAM_INT);
            $stmt->bindValue(":modelo", $repuesto->getIdModelo(), PDO::PARAM_INT);
            $stmt->bindValue(":precio", $repuesto->getPrecio(), PDO::PARAM_STR);
            $stmt->bindValue(":stock", $repuesto->getStock(), PDO::PARAM_INT);
            $stmt->bindValue(":tipoRepuesto", $repuesto->getTipoRepuesto(), PDO::PARAM_STR);
            $stmt->bindValue(":estado", $repuesto->getEstado(), PDO::PARAM_INT);
            return $stmt->execute();
        } catch (PDOException $ex) {
            echo "Error en update RepuestoDAO: " . $ex->getMessage();
            return false;
        }
    }

    public function delete($id) {
        try {
            $sql = "DELETE FROM Repuesto WHERE rep_id = :id";
            $stmt = $this->conx->prepare($sql);
            $stmt->bindParam(":id", $id, PDO::PARAM_INT);
            return $stmt->execute();
        } catch (PDOException $ex) {
            echo "Error en delete RepuestoDAO: " . $ex->getMessage();
            return false;
        }
    }
}
