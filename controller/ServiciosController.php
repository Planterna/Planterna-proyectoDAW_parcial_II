<?php
    require_once 'model/dao/ServiciosDAO.php';
    class ServiciosController {

        private $model;

        public function __construct() {
            $this->model = new ServiciosDAO();
        }

        public function index() {
            require_once VSERVICIOS.'formulario.php';
        }

    }


?>