<?php
//autor: Anthony Lopez
require_once 'config/Conexion.php';
require_once 'model/dto/Tecnico.php'; 
require_once 'model/dao/TecnicoDAO.php';

class TecnicoController {
    private $tecnicoDAO;
    private $conexion;

    public function __construct() {
        $this->conexion = Conexion::getConexion();
        $this->tecnicoDAO = new TecnicoDAO();
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
    }

    public function info() {
        require_once 'view/tecnico/tecnico_info.php';
    }

    public function listar() {
        $tecnicos = $this->tecnicoDAO->listarTecnicos();
        require_once 'view/tecnico/tecnico_list.php';
    }

    public function vista_registrar() {
        require_once 'view/tecnico/tecnico_new.php';
    }

    public function registrar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre = $_POST['nombre'];
            $cedula = $_POST['cedula'];
            $correo = $_POST['correo'];
            $telefono = $_POST['telefono'];
            $password_plana = $_POST['password'];
            $estado = isset($_POST['estado']) ? 1 : 0; 

            $password_hash = password_hash($password_plana, PASSWORD_DEFAULT);

            $tecnico = new Tecnico(
                null, 
                $nombre,
                $cedula,
                $correo,
                $telefono,
                $password_hash,
                2, 
                $estado,
                null, 
                0 
            );

            if ($this->tecnicoDAO->registrarTecnico($tecnico)) {
                $_SESSION['mensaje'] = "Técnico (Usuario) registrado exitosamente.";
                $_SESSION['color'] = "success";
            } else {
                $_SESSION['mensaje'] = "Error al registrar el técnico (usuario).";
                $_SESSION['color'] = "danger";
            }
        }
        header('Location: index.php?c=Tecnico&f=listar');
        exit();
    }

    public function vista_actualizar() {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $tecnico = $this->tecnicoDAO->obtenerTecnicoPorId($id);
            if ($tecnico) {
                require_once 'view/tecnico/tecnico_edit.php';
            } else {
                $_SESSION['mensaje'] = "Técnico no encontrado.";
                $_SESSION['color'] = "danger";
                header('Location: index.php?c=Tecnico&f=listar');
                exit();
            }
        } else {
            $_SESSION['mensaje'] = "ID de técnico no especificado.";
            $_SESSION['color'] = "danger";
            header('Location: index.php?c=Tecnico&f=listar');
            exit();
        }
    }

    public function actualizar() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id_user = $_POST['id_user'];
            $nombre = $_POST['nombre'];
            $cedula = $_POST['cedula'];
            $correo = $_POST['correo'];
            $telefono = $_POST['telefono'];
            $estado = isset($_POST['estado']) ? 1 : 0;

            // Al actualizar, mantenemos la contraseña y fecha_creacion existentes
            $tecnicoExistente = $this->tecnicoDAO->obtenerTecnicoPorId($id_user);
            $password_hash = $tecnicoExistente ? $tecnicoExistente->getPassword() : null;
            $fecha_creacion = $tecnicoExistente ? $tecnicoExistente->getFechaCreacion() : null;
            $notificaciones = $tecnicoExistente ? $tecnicoExistente->getNotificaciones() : 0;


            $tecnico = new Tecnico(
                $id_user,
                $nombre,
                $cedula,
                $correo,
                $telefono,
                $password_hash,
                2, // El rol SIEMPRE es 2
                $estado,
                $fecha_creacion,
                $notificaciones
            );

            if ($this->tecnicoDAO->actualizarTecnico($tecnico)) {
                $_SESSION['mensaje'] = "Técnico (Usuario) actualizado exitosamente.";
                $_SESSION['color'] = "success";
            } else {
                $_SESSION['mensaje'] = "Error al actualizar el técnico (usuario).";
                $_SESSION['color'] = "danger";
            }
        }
        header('Location: index.php?c=Tecnico&f=listar');
        exit();
    }

    public function eliminar() {
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            if ($this->tecnicoDAO->eliminarTecnico($id)) {
                $_SESSION['mensaje'] = "Técnico (Usuario) desactivado exitosamente.";
                $_SESSION['color'] = "success";
            } else {
                $_SESSION['mensaje'] = "Error al desactivar el técnico (usuario).";
                $_SESSION['color'] = "danger";
            }
        } else {
            $_SESSION['mensaje'] = "ID de técnico no especificado para desactivar.";
            $_SESSION['color'] = "danger";
        }
        header('Location: index.php?c=Tecnico&f=listar');
        exit();
    }

    public function solicitar_tecnico_simple() {
        if (isset($_GET['id_tecnico'])) {
            $id_tecnico = $_GET['id_tecnico'];
            $tecnico = $this->tecnicoDAO->obtenerTecnicoPorId($id_tecnico);

            if ($tecnico) {
                if ($this->tecnicoDAO->registrarSolicitudSimple($id_tecnico)) {
                    $_SESSION['mensaje'] = "Solicitud de servicio simple para " . htmlspecialchars($tecnico->getNombre()) . " registrada exitosamente.";
                    $_SESSION['color'] = "success";
                } else {
                    $_SESSION['mensaje'] = "Error al registrar la solicitud simple.";
                    $_SESSION['color'] = "danger";
                }
            } else {
                $_SESSION['mensaje'] = "Técnico no encontrado para la solicitud simple.";
                $_SESSION['color'] = "danger";
            }
        } else {
            $_SESSION['mensaje'] = "ID de técnico no especificado para la solicitud simple.";
            $_SESSION['color'] = "danger";
        }
        header('Location: index.php?c=Tecnico&f=listar_solicitudes_simples'); // Redirige al listado de solicitudes simples
        exit();
    }

    // NUEVA FUNCIÓN PARA LISTAR LAS SOLICITUDES SIMPLES
    public function listar_solicitudes_simples() {
        $solicitudes_simples = $this->tecnicoDAO->listarSolicitudesSimples();
        require_once 'view/tecnico/solicitudes_simples_list.php';
    }

public function limpiar_solicitudes_simples() {
        if ($this->tecnicoDAO->limpiarTodasSolicitudesSimples()) {
            $_SESSION['mensaje'] = "Todas las solicitudes simples han sido eliminadas exitosamente.";
            $_SESSION['color'] = "success";
        } else {
            $_SESSION['mensaje'] = "Error al intentar eliminar las solicitudes simples.";
            $_SESSION['color'] = "danger";
        }
        header('Location: index.php?c=Tecnico&f=listar_solicitudes_simples'); // Redirige de nuevo al listado
        exit();
    }

    
    }

?>