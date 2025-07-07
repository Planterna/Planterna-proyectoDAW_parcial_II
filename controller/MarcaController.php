<?php
require_once 'config/Config.php';

class MarcaController{
    private $model;

    public function __construct(){
        $this->model = new MarcaDAO();
    }


}

?>