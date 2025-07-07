<?php
require_once 'model/dao/ModeloDAO.php';

class ModeloController{
    private $modelModelo;

    public function __construct(){
        $this->modelModelo = new ModeloDAO();
    }
    public function getModel(){
            header('Content-Type: aplication/json');
            $idMarca = isset($_GET['idMarca']) ? (int)$_GET['idMarca'] : null;
            if($idMarca){
                $modelos = $this->modelModelo->filterModel($idMarca);
                echo json_encode($modelos);
            }else{
                echo json_encode([]);
            }
            exit();
        }
}
?>