<?php
// autor: Mero Araujo Jeremy
require_once 'config/Conexion.php';

class ModeloDAO{
    private $conx;

    public function __construct(){
        $this->conx = Conexion::getConexion();
    }

    public function filterModel($id){
        try{
            $sql = "SELECT * FROM modelos WHERE mod_idMarca = :idMarca";
            $stmt = $this->conx->prepare($sql);
            $stmt->bindParam(":idMarca", $id, PDO::PARAM_INT);
            $stmt->execute();
            $resultados = $stmt->fetchAll(PDO::FETCH_OBJ);
            return $resultados ?: [];
        }catch(PDOException $ex){
            echo "Error en filterModel ModeloDAO: " . $ex->getMessage();    
            return []; 
        }
    }
}
?>
