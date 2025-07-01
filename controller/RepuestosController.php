<?php
    require_once 'model/dao/ProductosDAO.php';
    class RepuestosController {

        private $model;

        public function __construct() {
            $this->model = new ProductosDAO();
        }

        public function index() {
            require_once VPRODUCTOS .'main.php';
        }

    }


?>