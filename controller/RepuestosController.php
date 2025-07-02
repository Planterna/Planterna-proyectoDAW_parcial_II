<?php
    require_once 'model/dao/RepuestosDAO.php';
    class RepuestosController {

        private $model;

        public function __construct() {
            $this->model = new RepuestosDAO();
        }

        public function index() {
            require_once VREPUESTOS .'principal.php';
        }

    }


?>