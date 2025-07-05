    <!--autor: Jonathan Alejandro Baquerizo-->

    <?php
    require_once 'model/dto/Servicios.php';
    require_once 'model/dao/ServiciosDAO.php';
    require_once 'util/functionsValidationsServices.php';
    require_once 'util/functions.php';
    class ServiciosController
    {

        private $model;
        private $util;
        private $message;


        public function __construct()
        {
            $this->model = new ServiciosDAO();
            $this->util = new functionValidationsServices();
            $this->message = new FunctionUtil();
        }

        public function index()
        {
            require_once VSERVICIOS . 'informacion.php';
        }

        public function formInit()
        {
            require_once VSERVICIOS . 'formulario.php';
        }

        public function formSearch()
        {
            $rol = 1;
            // $rol = $this->model->searchRol();
            //remplazar por el id cuando este el login
            $resultados = $this->model->selectAllforId("3");

            require_once VSERVICIOS . 'consultas.php';
        }

        public function view_edit()
        {
            //leer el id del servicio
            $id = htmlentities($_GET['id']);
            //obtiene el servicio del modelo
            $serv = $this->model->selectOne($id);
            //llamar a la vista del formulario de editar servicio
            require_once VSERVICIOS . "formularioEdit.php";
        }

        public function newService()
        {

            $name =  $this->util->validateName($_POST['nombre']);
            $cedula = $this->util->validateNumber($_POST['cedula'], "Cédula");
            $telefono = $this->util->validateNumber($_POST['telefono'], "Teléfono");
            $correo = $this->util->validateEmail($_POST['correo']);
            $marcaVehiculo = $this->util->validateName($_POST['marcaVehiculo']);
            $placaVehiculo = $this->util->validatePlaca($_POST['placaVehiculo']);
            $tipoServicio = $this->util->validBasic($_POST['tipoServicio'], "tipo de Servicio");
            $errores = $this->util->addError($name, $cedula, $telefono, $correo, $placaVehiculo,$marcaVehiculo, $tipoServicio);

            $result = ($name == "success" && $cedula == "success" &&
                $telefono == "success" && $correo == "success" &&
                $marcaVehiculo == "success" && $placaVehiculo == "success" && $tipoServicio == "success"
            ) ? true: false; 

            //leer los parametros del formulario
            $serv = $this->populate();
            //guardar (llamando al modelo)
            $test = $result ? $this->model->update($serv): false;
            
            $this->message->redirectWithMessage($test , "servicio editado exitosamente", "No se pudo editar el servicio, " . $errores, "index.php?c=servicios&f=formInit");
        }


        public function search()
        {
            //leer los parametros enviados en las peticiones
            $parametro = htmlentities($_POST['b']); //falta verificar
            //comunicacion con el modelo para (obtener datos) traer la lista de todos los servicios
            $resultados = $this->model->selectAll("$parametro");
            //require_once 'view/servicios/servicios.list.php';
            require_once VSERVICIOS . 'consultas.php';
        }


        public function delete()
        {
            //leer parametros enviados en las peticiones
            $id = htmlentities($_GET['id']);
            //comunicacion con el modelo
            $exito = $this->model->logicalDelete($id);
            $this->message->redirectWithMessage($exito, "servicio eliminado exitosamente", "No se pudo eliminar el servicio", "index.php?c=servicios&f=formSearch");
        }

        public function edit()
        {
            //ejemplo validar ingreso a acciones segun el rol del usuario
            if (!isset($_SESSION)) session_start();
            if (empty($_SESSION['rol'] && $_SESSION['rol'] !== 'admin')) {
                //$this->redirectWithMessage(false, "Acceso denegado", "No tiene permiso para acceder a esta página", "index.php");
            }

            //verificar los parametros enviados por el formulario
            if (empty($_POST['id']) && empty($_POST['nombre']) && empty($_POST['precio']) && empty($_POST['categoria'])) {
                $this->message->redirectWithMessage(false, "Faltan datos obligatorios", "No se pudo editar el servicio", "index.php?c=servicios&f=view_edit&id=" . $_POST['id']);
            }

            $name =  $this->util->validateName($_POST['nombre']);
            $cedula = $this->util->validateNumber($_POST['cedula'], "Cédula");
            $telefono = $this->util->validateNumber($_POST['telefono'], "Teléfono");
            $correo = $this->util->validateEmail($_POST['correo']);
            $marcaVehiculo = $this->util->validateName($_POST['marcaVehiculo']);
            $placaVehiculo = $this->util->validatePlaca($_POST['placaVehiculo']);
            $tipoServicio = $this->util->validBasic($_POST['tipoServicio'], "tipo de Servicio");
            $errores = $this->util->addError($name, $cedula, $telefono, $correo, $placaVehiculo,$marcaVehiculo, $tipoServicio);

            $result = ($name == "success" && $cedula == "success" &&
                $telefono == "success" && $correo == "success" &&
                $marcaVehiculo == "success" && $placaVehiculo == "success" && $tipoServicio == "success"
            ) ? true: false;
                $serv = $this->populate();
                //guardar (llamando al modelo)
                $test = $result ? $this->model->update($serv): false;
            
                $this->message->redirectWithMessage($test , "servicio editado exitosamente", "No se pudo editar el servicio, " . $errores, "index.php?c=servicios&f=view_edit&id=" . $serv->getId());

            
        }

        public function populate()
        {
            //lectura de parametros
            $serv = new Servicio();
            $serv->setId(htmlentities((isset($_POST['id'])) ? $_POST['id'] : null));
            $serv->setNombre(htmlentities($_POST['nombre']));
            $serv->setCedula(htmlentities($_POST['cedula']));
            $serv->setTelefono(htmlentities($_POST['telefono']));
            $serv->setCorreo(htmlentities($_POST['correo']));
            $serv->setMarcaVehiculo(htmlentities(strtoupper($_POST['marcaVehiculo'])));
            $serv->setPlacaVehiculo(htmlentities(strtoupper($_POST['placaVehiculo'])));
            $serv->setTipoServicio(htmlentities($_POST['tipoServicio']));
            $fecha = new DateTime('now');
            $serv->setFechaCreacion($fecha->format("Y-m-d H:i:s"));
            $fechaMod = new DateTime('now');
            $serv->setfechaModificacion($fechaMod->format("Y-m-d H:i:s"));
            $serv->setStatusLogical(htmlentities($_POST["statusLogical"]));
            
            return $serv;
        }
    }


    ?>