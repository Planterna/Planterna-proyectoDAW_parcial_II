<?php
// autor: Mero Araujo Jeremy
require_once 'config/Conexion.php';

class MarcaDAO{
    private $conx;

    public function __construct(){
        $this->conx = Conexion::getConexion();
    }

    public function selectAll($parametro){
        try{
            $sql = "SELECT mar_id, mar_nombre FROM marcas";
            $stmt = $this->conx->prepare($sql);
            $stmt->execute();
            $resultado = $stmt->fetchAll(PDO::FETCH_OBJ);
            return $resultado;
        }catch(PDOException $ex){
            echo "Error en selectAll MarcaDAO: " . $ex->getMessage();
            return [];
        }
    }
}
?>
