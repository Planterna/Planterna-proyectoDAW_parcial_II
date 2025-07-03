<!--autor: Jonathan Alejandro Baquerizo-->

<?php
    require_once 'model/dto/Servicios.php';
    require_once 'model/dao/ServiciosDAO.php';
    class ServiciosController {

        private $model;

        public function __construct() {
            $this->model = new ServiciosDAO();
        }

        public function index() {
            require_once VSERVICIOS.'informacion.php';
        }

        public function formInit(){
            require_once VSERVICIOS.'formulario.php';
        }

        public function formSearch(){
            require_once VSERVICIOS.'consultas.php';
        }

        public function newService(){
              if(empty($_POST['nombre']) || empty($_POST['cedula']) 
                || empty($_POST['telefono']) || empty($_POST['correo']) || empty($_POST['marcaVehiculo'])
                || empty($_POST['placaVehiculo']) || empty($_POST['tipoServicio'])){
            $this->redirectWithMessage(false, "Faltan datos obligatorios", "No se pudo crear el servicio", "index.php?c=servicios&f=formInit");
        }   

        //leer los parametros del formulario
        $serv = $this->populate();
        //guardar (llamando al modelo)
        $exito = $this->model->insert($serv);
        //manejar el flujo de ventanas
        $this->redirectWithMessage($exito, "Servicio creado exitosamente", "No se pudo crear el servicio", "index.php?c=servicios&f=formInit");

        }

         public function redirectWithMessage($exito, $exitoMsg, $errorMsg, $url){
        if(!isset($_SESSION))session_start();
        $_SESSION['mensaje']=($exito)? $exitoMsg : $errorMsg;
        $_SESSION['color']=($exito)? "primary" : "danger";
        header("Location: ".$url); //flujo de ventanas
        }

         public function populate(){
        //lectura de parametros
        $serv = new Servicio();
        $serv->setNombre(htmlentities($_POST['nombre']));
        $serv->setCedula(htmlentities($_POST['cedula']));
        $serv->setTelefono(htmlentities($_POST['telefono']));
        $serv->setCorreo(htmlentities($_POST['correo']));
        $serv->setMarcaVehiculo(htmlentities($_POST['marcaVehiculo']));
        $serv->setPlacaVehiculo(htmlentities($_POST['placaVehiculo']));
        $serv->setTipoServicio(htmlentities($_POST['tipoServicio']));
        $fecha = new DateTime('now');
        $serv->setFechaCreacion($fecha->format("Y-m-d H:i:s"));
        return $serv;
        }
    }


?>