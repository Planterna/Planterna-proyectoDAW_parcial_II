<?php
    require_once 'config/Conexion.php';
    class ProductosDAO {

        private $con;

        public function __construct() {
            $this->con = Conexion::getConexion();
        }

    }


?>