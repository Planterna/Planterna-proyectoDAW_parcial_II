<?php
    require_once 'config/Conexion.php';
    class ServiciosDAO {

        private $con;

        public function __construct() {
            $this->con = Conexion::getConexion();
        }

    }


?>