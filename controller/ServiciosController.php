    <?php
      //autor: Jonathan Alejandro Baquerizo
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
            if (!isset($_SESSION)) session_start();
            $rol = !empty($_SESSION['loggedIn']) ? ($_SESSION['rol'] ?? 0) : 0;
            require_once VSERVICIOS . 'informacion.php';
        }

        public function formInit()
        {
            if ($this->util->validationSession()) {
                $rol = $_SESSION['rol'];
                if ($rol == 1 || $rol == 3) {
                    $id_user = $this->util->validationId();
                    require_once VSERVICIOS . 'formulario.php';
                }
            }
        }

        public function formSearch()
        {
            $this->util->validationSession();
            $rol = $this->util->validationRole();
            $id_user = $this->util->validationId();
            if ($rol == 1) {
                $resultados = $this->model->selectAllforId($id_user);
            } elseif ($rol == 2 || $rol == 3) {
                $id_tecnico = $this->util->validationId();
                $resultados = $this->model->selectAllItems();
            }
            require_once VSERVICIOS . 'consultas.php';
        }
        public function view_edit()
        {
            $this->util->validationSession();
            $id = htmlentities($_GET['id']);
            $serv = $this->model->selectOne($id);
            require_once VSERVICIOS . "formulario.php";
        }

        public function newService()
        {
            $this->util->validationSession();
            $name =  $this->util->validateName($_POST['nombre']);
            $cedula = $this->util->validateNumber($_POST['cedula'], "Cédula");
            $telefono = $this->util->validateNumber($_POST['telefono'], "Teléfono");
            $correo = $this->util->validateEmail($_POST['correo']);
            $marcaVehiculo = $this->util->validateName($_POST['marcaVehiculo']);
            $placaVehiculo = $this->util->validatePlaca($_POST['placaVehiculo']);
            $tipoServicio = $this->util->validBasic($_POST['tipoServicio'], "tipo de Servicio");
            $id_user = $this->util->validBasic($_POST['id_user'], "userid");
            $errores = $this->util->addError($name, $cedula, $telefono, $correo, $placaVehiculo, $marcaVehiculo, $tipoServicio, $id_user);
            $result = ($name == "success" && $cedula == "success" &&
                $telefono == "success" && $correo == "success" &&
                $marcaVehiculo == "success" && $placaVehiculo == "success" && $tipoServicio == "success" && $id_user == "success"
            ) ? true : false;
            $serv = $this->populate();
            $test = $result ? $this->model->insert($serv) : false;
            $this->message->redirectWithMessage($test, "servicio creado exitosamente", "No se pudo crear el servicio, " . $errores, "index.php?c=servicios&f=formInit");
        }


        public function search()
        {
            $this->util->validationSession();
            $rol = $this->util->validationRole();
            $parametro = htmlentities($_POST['b']); 
            $id_user = $this->util->validationId();  
            if($rol == 1){
                $resultados = $this->model->selectAll($parametro, $id_user);
            }else{
                $id_tecnico = $this->util->validationId();
                $resultados = $this->model->selectAllAdTc($parametro);
            }
            require_once VSERVICIOS . 'consultas.php';
        }


        public function delete()
        {
            $this->util->validationSession();
            $id = htmlentities($_GET['id']);
            $exito = $this->model->logicalDelete($id);
            $this->message->redirectWithMessage($exito, "servicio eliminado exitosamente", "No se pudo eliminar el servicio", "index.php?c=servicios&f=formSearch");
        }

        public function edit()
        {
            $this->util->validationSession();
            $name =  $this->util->validateName($_POST['nombre']);
            $cedula = $this->util->validateNumber($_POST['cedula'], "Cédula");
            $telefono = $this->util->validateNumber($_POST['telefono'], "Teléfono");
            $correo = $this->util->validateEmail($_POST['correo']);
            $marcaVehiculo = $this->util->validateName($_POST['marcaVehiculo']);
            $placaVehiculo = $this->util->validatePlaca($_POST['placaVehiculo']);
            $tipoServicio = $this->util->validBasic($_POST['tipoServicio'], "tipo de Servicio");
            $id_user = $this->util->validBasic($_POST['id_user'], "userid");
            $errores = $this->util->addError($name, $cedula, $telefono, $correo, $placaVehiculo, $marcaVehiculo, $tipoServicio, $id_user);
            $result = ($name == "success" && $cedula == "success" &&
                $telefono == "success" && $correo == "success" &&
                $marcaVehiculo == "success" && $placaVehiculo == "success" && $tipoServicio == "success" && $id_user == "success"
            ) ? true : false;
            $serv = $this->populate();
            $test = $result ? $this->model->update($serv) : false;
            $this->message->redirectWithMessage($test, "servicio editado exitosamente", "No se pudo editar el servicio, " . $errores, "index.php?c=servicios&f=view_edit&id=" . $serv->getId());
        }


        public function changeService()
        {
            $this->util->validationSession();
            $id_tecnico = $this->util->validBasic($_POST['id_tecnico'], "id User Tecnico");
            $tipoServicio = $this->util->validBasic($_POST['tipoServicio'], "tipo de Servicio");
            $estado = $this->util->validBasic($_POST['estado'], "estado");
            $result = ($estado == "success" && $tipoServicio == "success" && $id_tecnico == "success") ? true : false;
            $serv = $this->populateTec();
            $test = $result ? $this->model->updateTec($serv) : false;
            $this->message->redirectWithMessage($test, "servicio editado exitosamente", "No se pudo editar el servicio ", "index.php?c=servicios&f=formSearch");
        }

        public function populate()
        {
            $serv = new Servicio();
            $serv->setId(htmlentities((isset($_POST['id'])) ? $_POST['id'] : null));
            $serv->setNombre(htmlentities($_POST['nombre']));
            $serv->setCedula(htmlentities($_POST['cedula']));
            $serv->setTelefono(htmlentities($_POST['telefono']));
            $serv->setCorreo(htmlentities($_POST['correo']));
            $serv->setId_user(htmlentities($_POST['id_user'] ? $_POST['id_user'] : null));
            $serv->setMarcaVehiculo(htmlentities(strtoupper($_POST['marcaVehiculo'])));
            $serv->setPlacaVehiculo(htmlentities(strtoupper($_POST['placaVehiculo'])));
            $serv->setTipoServicio(htmlentities($_POST['tipoServicio']));
            $fecha = new DateTime('now');
            $serv->setFechaCreacion($fecha->format("Y-m-d H:i:s"));
            $fechaMod = new DateTime('now');
            $serv->setfechaModificacion($fechaMod->format("Y-m-d H:i:s"));
            $serv->setStatusLogical(htmlentities($_POST["statusLogical" ?? 1]));
            return $serv;
        }

        public function populateTec()
        {
            $serv = new Servicio();
            $serv->setId(htmlentities((isset($_POST['id'])) ? $_POST['id'] : null));
            $serv->setTipoServicio(htmlentities($_POST['tipoServicio']));
            $serv->setEstado(htmlentities($_POST['estado']));
            $serv->setId_tecnico(htmlentities($_POST['id_tecnico'] ? $_POST['id_tecnico'] : null));
            $fechaMod = new DateTime('now');
            $serv->setfechaModificacion($fechaMod->format("Y-m-d H:i:s"));
            $serv->setStatusLogical(htmlentities($_POST["statusLogical"]));
            return $serv;
        }
    }

    ?>