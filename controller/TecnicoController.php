<?php
//autor: Anthony Lopez
require_once 'config/Conexion.php';
require_once 'model/dto/Tecnico.php';
require_once 'model/dao/TecnicoDAO.php';
require_once 'util/functionReplacement.php'; 

class TecnicoController {
    private $tecnicoDAO;
    private $conexion;

    public function __construct() {
        $this->conexion = Conexion::getConexion();
        $this->tecnicoDAO = new TecnicoDAO();

    }

    public function info() {
        validarSesion();
        validarAcceso([1, 2, 3]); 
        require_once 'view/tecnico/tecnico_info.php';
    }

    public function listar() {
        validarSesion();
        validarAcceso([1, 2, 3]); 
        $tecnicos = $this->tecnicoDAO->listarTecnicos();
        require_once 'view/tecnico/tecnico_list.php';
    }

    public function vista_registrar() {
        validarSesion();
        validarAcceso([1, 3]);

        $datosFormulario = [
            'nombre' => $_SESSION['old_input']['nombre'] ?? '',
            'cedula' => $_SESSION['old_input']['cedula'] ?? '',
            'correo' => $_SESSION['old_input']['correo'] ?? '',
            'telefono' => $_SESSION['old_input']['telefono'] ?? '',
            'estado' => $_SESSION['old_input']['estado'] ?? 0,
        ];
        unset($_SESSION['old_input']);

        require_once 'view/tecnico/tecnico_new.php';
    }

    public function registrar() {
        validarSesion();
        validarAcceso([1, 3]); 

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $nombre = $_POST['nombre'] ?? '';
            $cedula = $_POST['cedula'] ?? '';
            $correo = $_POST['correo'] ?? '';
            $telefono = $_POST['telefono'] ?? '';
            $password_plana = $_POST['password'] ?? '';
            $estado = isset($_POST['estado']) ? 1 : 0;

            $errores = [];

            if (!validarNombre($nombre)) { 
                $errores['nombre'] = "El nombre es obligatorio y debe tener entre 3 y 40 caracteres válidos.";
            }

            if (empty($cedula) || !preg_match('/^\d{10}$/', $cedula)) { 
                $errores['cedula'] = "La cédula es obligatoria y debe tener 10 dígitos.";
            }
            if (empty($correo) || !filter_var($correo, FILTER_VALIDATE_EMAIL)) {
                $errores['correo'] = "El correo es obligatorio y debe ser un formato válido.";
            }
            if (empty($telefono) || !preg_match('/^\d{10}$/', $telefono)) { 
                $errores['telefono'] = "El teléfono es obligatorio y debe tener 10 dígitos.";
            }
            if (empty($password_plana) || strlen($password_plana) < 6) {
                $errores['password'] = "La contraseña es obligatoria y debe tener al menos 6 caracteres.";
            }


            if (!empty($errores)) {
                $_SESSION['mensaje'] = implode("<br>", $errores);
                $_SESSION['color'] = "danger";
                $_SESSION['old_input'] = $_POST; 
                header('Location: index.php?c=Tecnico&f=vista_registrar');
                exit();
            }

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

            redirectWithMessage(
                $this->tecnicoDAO->registrarTecnico($tecnico),
                "Técnico (Usuario) registrado exitosamente.",
                "Error al registrar el técnico (usuario).",
                "index.php?c=Tecnico&f=listar"
            );

        } else {
            $_SESSION['mensaje'] = "Método de solicitud no permitido.";
            $_SESSION['color'] = "danger";
            header('Location: index.php?c=Tecnico&f=listar');
            exit();
        }
    }

    public function vista_actualizar() {
        validarSesion();
        validarAcceso([1, 3]); 
        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            $tecnico = $this->tecnicoDAO->obtenerTecnicoPorId($id);
            if ($tecnico) {
                $datosFormulario = [
                    'id_user' => $_SESSION['old_input']['id_user'] ?? $tecnico->getIdUser(),
                    'nombre' => $_SESSION['old_input']['nombre'] ?? $tecnico->getNombre(),
                    'cedula' => $_SESSION['old_input']['cedula'] ?? $tecnico->getCedula(),
                    'correo' => $_SESSION['old_input']['correo'] ?? $tecnico->getCorreo(),
                    'telefono' => $_SESSION['old_input']['telefono'] ?? $tecnico->getTelefono(),
                    'estado' => $_SESSION['old_input']['estado'] ?? $tecnico->getEstado(),
                ];
                unset($_SESSION['old_input']);
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
        validarSesion();
        validarAcceso([1, 3]); 

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id_user = $_POST['id_user'] ?? '';
            $nombre = $_POST['nombre'] ?? '';
            $cedula = $_POST['cedula'] ?? '';
            $correo = $_POST['correo'] ?? '';
            $telefono = $_POST['telefono'] ?? '';
            $estado = isset($_POST['estado']) ? 1 : 0;

            $errores = [];

            if (empty($id_user) || !is_numeric($id_user)) {
                $errores['id_user'] = "ID de técnico inválido.";
            }
            if (!validarNombre($nombre)) {
                $errores['nombre'] = "El nombre es obligatorio y debe tener entre 3 y 40 caracteres válidos.";
            }
            if (empty($cedula) || !preg_match('/^\d{10}$/', $cedula)) {
                $errores['cedula'] = "La cédula es obligatoria y debe tener 10 dígitos.";
            }
            if (empty($correo) || !filter_var($correo, FILTER_VALIDATE_EMAIL)) {
                $errores['correo'] = "El correo es obligatorio y debe ser un formato válido.";
            }
            if (empty($telefono) || !preg_match('/^\d{10}$/', $telefono)) {
                $errores['telefono'] = "El teléfono es obligatorio y debe tener 10 dígitos.";
            }

            if (!empty($errores)) {
                $_SESSION['mensaje'] = implode("<br>", $errores);
                $_SESSION['color'] = "danger";
                $_SESSION['old_input'] = $_POST; 
                header('Location: index.php?c=Tecnico&f=vista_actualizar&id=' . urlencode($id_user));
                exit();
            }

            $tecnicoExistente = $this->tecnicoDAO->obtenerTecnicoPorId($id_user);
            if (!$tecnicoExistente) {
                $_SESSION['mensaje'] = "Técnico a actualizar no encontrado.";
                $_SESSION['color'] = "danger";
                header('Location: index.php?c=Tecnico&f=listar');
                exit();
            }


            $password_hash = $tecnicoExistente->getPassword();
            $fecha_creacion = $tecnicoExistente->getFechaCreacion();
            $notificaciones = $tecnicoExistente->getNotificaciones();

            $tecnico = new Tecnico(
                $id_user,
                $nombre,
                $cedula,
                $correo,
                $telefono,
                $password_hash,
                2, 
                $estado,
                $fecha_creacion,
                $notificaciones
            );

            redirectWithMessage(
                $this->tecnicoDAO->actualizarTecnico($tecnico),
                "Técnico (Usuario) actualizado exitosamente.",
                "Error al actualizar el técnico (usuario).",
                "index.php?c=Tecnico&f=listar"
            );

        } else {
            $_SESSION['mensaje'] = "Método de solicitud no permitido.";
            $_SESSION['color'] = "danger";
            header('Location: index.php?c=Tecnico&f=listar');
            exit();
        }
    }

    public function eliminar() {
        validarSesion();
        validarAcceso([1, 3]); 

        if (isset($_GET['id'])) {
            $id = $_GET['id'];
            redirectWithMessage(
                $this->tecnicoDAO->eliminarTecnico($id),
                "Técnico (Usuario) desactivado exitosamente.",
                "Error al desactivar el técnico (usuario).",
                "index.php?c=Tecnico&f=listar"
            );
        } else {
            $_SESSION['mensaje'] = "ID de técnico no especificado para desactivar.";
            $_SESSION['color'] = "danger";
            header('Location: index.php?c=Tecnico&f=listar');
            exit();
        }
    }

    public function solicitar_tecnico_simple() {
        validarSesion();
        validarAcceso([1, 2, 3]); 
        if (isset($_GET['id_tecnico'])) {
            $id_tecnico = $_GET['id_tecnico'];
            $tecnico = $this->tecnicoDAO->obtenerTecnicoPorId($id_tecnico);

            if ($tecnico) {
                redirectWithMessage(
                    $this->tecnicoDAO->registrarSolicitudSimple($id_tecnico),
                    "Solicitud de servicio simple para " . htmlspecialchars($tecnico->getNombre()) . " registrada exitosamente.",
                    "Error al registrar la solicitud simple.",
                    "index.php?c=Tecnico&f=listar_solicitudes_simples"
                );
            } else {
                $_SESSION['mensaje'] = "Técnico no encontrado para la solicitud simple.";
                $_SESSION['color'] = "danger";
                header('Location: index.php?c=Tecnico&f=listar_solicitudes_simples');
                exit();
            }
        } else {
            $_SESSION['mensaje'] = "ID de técnico no especificado para la solicitud simple.";
            $_SESSION['color'] = "danger";
            header('Location: index.php?c=Tecnico&f=listar_solicitudes_simples');
            exit();
        }
    }

    public function listar_solicitudes_simples() {
        validarSesion();
        validarAcceso([1, 2, 3]); 
        $solicitudes_simples = $this->tecnicoDAO->listarSolicitudesSimples();
        require_once 'view/tecnico/solicitudes_simples_list.php';
    }

    public function limpiar_solicitudes_simples() {
        validarSesion();
        validarAcceso([1]); 
        redirectWithMessage(
            $this->tecnicoDAO->limpiarTodasSolicitudesSimples(),
            "Todas las solicitudes simples han sido eliminadas exitosamente.",
            "Error al intentar eliminar las solicitudes simples.",
            "index.php?c=Tecnico&f=listar_solicitudes_simples"
        );
    }
}