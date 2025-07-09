<?php
//autor:dean

require_once 'config/Conexion.php';
require_once 'model/dto/Cotizacion.php';
require_once 'model/dao/CotizacionDAO.php';

class CotizacionController {
    private $cotizacionDAO;
    private $conexion;

    public function __construct() {
        $this->conexion = Conexion::getConexion();
        $this->cotizacionDAO = new CotizacionDAO();
    }

    public function info() {
        require_once 'view/cotizacion/cotizacion_info.php';
    }

    public function listar() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        $cotizaciones = $this->cotizacionDAO->listarCotizaciones();
        require_once 'view/cotizacion/cotizacion_list.php';
    }

    public function form_registrar() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        require_once 'view/cotizacion/cotizacion_new.php';
    }

    public function registrar() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $cliente_nombre = isset($_POST['cliente_nombre']) ? trim($_POST['cliente_nombre']) : '';
            $cliente_correo = isset($_POST['cliente_correo']) ? trim($_POST['cliente_correo']) : '';
            $cliente_telefono = isset($_POST['cliente_telefono']) ? trim($_POST['cliente_telefono']) : '';
            $descripcion_servicio = isset($_POST['descripcion_servicio']) ? trim($_POST['descripcion_servicio']) : '';

            $errors = [];

            if (empty($cliente_nombre)) {
                $errors[] = "El nombre del cliente es obligatorio.";
            } elseif (strlen($cliente_nombre) > 100) {
                $errors[] = "El nombre del cliente es demasiado largo (máx. 100 caracteres).";
            }

            if (empty($descripcion_servicio)) {
                $errors[] = "La descripción del servicio es obligatoria.";
            } elseif (strlen($descripcion_servicio) > 65535) {
                $errors[] = "La descripción del servicio es demasiado larga.";
            }

            if (empty($cliente_correo)) {
                $errors[] = "El correo electrónico es obligatorio.";
            } elseif (!filter_var($cliente_correo, FILTER_VALIDATE_EMAIL)) {
                $errors[] = "El formato del correo electrónico no es válido.";
            } elseif (strlen($cliente_correo) > 100) {
                $errors[] = "El correo electrónico es demasiado largo (máx. 100 caracteres).";
            }


            if (!empty($cliente_telefono) && !preg_match('/^[0-9]{7,20}$/', $cliente_telefono)) {
                $errors[] = "El teléfono solo debe contener números (7-20 dígitos).";
            } elseif (strlen($cliente_telefono) > 20) {
                $errors[] = "El número de teléfono es demasiado largo (máx. 20 dígitos).";
            }

            if (!empty($errors)) {
                $_SESSION['mensaje'] = implode("<br>", $errors);
                $_SESSION['color'] = "danger";
                $_SESSION['old_input'] = $_POST;
                header('Location: index.php?c=Cotizacion&f=form_registrar');
                exit();
            }

            $cotizacion = new Cotizacion(
                null,
                $cliente_nombre,
                $cliente_correo,
                $cliente_telefono,
                $descripcion_servicio,
                'Pendiente', 
                null, 
                null  
            );

            if ($this->cotizacionDAO->registrarCotizacion($cotizacion)) {
                $_SESSION['mensaje'] = "Cotización registrada exitosamente.";
                $_SESSION['color'] = "success";
            } else {
                $_SESSION['mensaje'] = "Error al registrar la cotización. Intente de nuevo.";
                $_SESSION['color'] = "danger";
            }
        } else {
            $_SESSION['mensaje'] = "Método de solicitud no permitido.";
            $_SESSION['color'] = "danger";
        }
        header('Location: index.php?c=Cotizacion&f=listar');
        exit();
    }

    public function form_editar() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        if (isset($_GET['id']) && is_numeric($_GET['id'])) {
            $id_cotizacion = $_GET['id'];
            $cotizacion = $this->cotizacionDAO->obtenerCotizacionPorId($id_cotizacion);

            if ($cotizacion) {
                require_once 'view/cotizacion/cotizacion_edit.php';
            } else {
                $_SESSION['mensaje'] = "Cotización no encontrada.";
                $_SESSION['color'] = "danger";
                header('Location: index.php?c=Cotizacion&f=listar');
                exit();
            }
        } else {
            $_SESSION['mensaje'] = "ID de cotización no especificado o inválido para editar.";
            $_SESSION['color'] = "danger";
            header('Location: index.php?c=Cotizacion&f=listar');
            exit();
        }
    }

    public function actualizar() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id_cotizacion = isset($_POST['id_cotizacion']) ? $_POST['id_cotizacion'] : null;
            $cliente_nombre = isset($_POST['cliente_nombre']) ? trim($_POST['cliente_nombre']) : '';
            $cliente_correo = isset($_POST['cliente_correo']) ? trim($_POST['cliente_correo']) : '';
            $cliente_telefono = isset($_POST['cliente_telefono']) ? trim($_POST['cliente_telefono']) : '';
            $descripcion_servicio = isset($_POST['descripcion_servicio']) ? trim($_POST['descripcion_servicio']) : '';
            $estado = isset($_POST['estado']) ? trim($_POST['estado']) : '';

            $errors = [];
            $estados_validos = ['Pendiente', 'Aceptada', 'Rechazada', 'Completada', 'Cancelada'];

            if (empty($id_cotizacion) || !is_numeric($id_cotizacion)) {
                $errors[] = "ID de cotización inválido.";
            }
            if (empty($cliente_nombre)) {
                $errors[] = "El nombre del cliente es obligatorio.";
            } elseif (strlen($cliente_nombre) > 100) {
                $errors[] = "El nombre del cliente es demasiado largo (máx. 100 caracteres).";
            }

            if (empty($descripcion_servicio)) {
                $errors[] = "La descripción del servicio es obligatoria.";
            } elseif (strlen($descripcion_servicio) > 65535) {
                $errors[] = "La descripción del servicio es demasiado larga.";
            }

            if (empty($cliente_correo)) {
                $errors[] = "El correo electrónico es obligatorio.";
            } elseif (!filter_var($cliente_correo, FILTER_VALIDATE_EMAIL)) {
                $errors[] = "El formato del correo electrónico no es válido.";
            } elseif (strlen($cliente_correo) > 100) {
                $errors[] = "El correo electrónico es demasiado largo (máx. 100 caracteres).";
            }

            if (!empty($cliente_telefono) && !preg_match('/^[0-9]{7,20}$/', $cliente_telefono)) {
                $errors[] = "El teléfono solo debe contener números (7-20 dígitos).";
            } elseif (strlen($cliente_telefono) > 20) {
                $errors[] = "El número de teléfono es demasiado largo (máx. 20 dígitos).";
            }

            if (!in_array($estado, $estados_validos)) {
                $errors[] = "El estado seleccionado no es válido.";
            }

            if (!empty($errors)) {
                $_SESSION['mensaje'] = implode("<br>", $errors);
                $_SESSION['color'] = "danger";
                $_SESSION['old_input'] = $_POST;
                header('Location: index.php?c=Cotizacion&f=form_editar&id=' . $id_cotizacion);
                exit();
            }

            $cotizacion = new Cotizacion(
                $id_cotizacion,
                $cliente_nombre,
                $cliente_correo,
                $cliente_telefono,
                $descripcion_servicio,
                $estado,
                null, 
                null  
            );

            if ($this->cotizacionDAO->actualizarCotizacion($cotizacion)) {
                $_SESSION['mensaje'] = "Cotización actualizada exitosamente.";
                $_SESSION['color'] = "success";
            } else {
                $_SESSION['mensaje'] = "Error al actualizar la cotización. Intente de nuevo.";
                $_SESSION['color'] = "danger";
            }
        } else {
            $_SESSION['mensaje'] = "Método de solicitud no permitido.";
            $_SESSION['color'] = "danger";
        }
        header('Location: index.php?c=Cotizacion&f=listar');
        exit();
    }

    public function eliminar() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        if (isset($_GET['id']) && is_numeric($_GET['id'])) {
            $id = $_GET['id'];
            if ($this->cotizacionDAO->eliminarCotizacion($id)) {
                $_SESSION['mensaje'] = "Cotización eliminada exitosamente.";
                $_SESSION['color'] = "success";
            } else {
                $_SESSION['mensaje'] = "Error al eliminar la cotización. Puede que esté asociada a otros registros o que no exista.";
                $_SESSION['color'] = "danger";
            }
        } else {
            $_SESSION['mensaje'] = "ID de cotización no especificado o inválido para eliminar.";
            $_SESSION['color'] = "danger";
        }
        header('Location: index.php?c=Cotizacion&f=listar');
        exit();
    }

    public function cambiar_estado() {
        if (session_status() == PHP_SESSION_NONE) {
            session_start();
        }
        $id_cotizacion = isset($_GET['id']) ? $_GET['id'] : null;
        $nuevo_estado = isset($_GET['estado']) ? $_GET['estado'] : null;

        $estados_validos = ['Pendiente', 'Aceptada', 'Rechazada', 'Completada', 'Cancelada'];
        if (empty($id_cotizacion) || !is_numeric($id_cotizacion) || empty($nuevo_estado) || !in_array($nuevo_estado, $estados_validos)) {
            $_SESSION['mensaje'] = "Datos inválidos para cambiar el estado de la cotización.";
            $_SESSION['color'] = "danger";
            header('Location: index.php?c=Cotizacion&f=listar');
            exit();
        }

        if ($this->cotizacionDAO->cambiarEstadoCotizacion($id_cotizacion, $nuevo_estado)) {
            $_SESSION['mensaje'] = "Estado de la cotización actualizado a '" . htmlspecialchars($nuevo_estado) . "' exitosamente.";
            $_SESSION['color'] = "success";
        } else {
            $_SESSION['mensaje'] = "Error al cambiar el estado de la cotización.";
            $_SESSION['color'] = "danger";
        }
        header('Location: index.php?c=Cotizacion&f=listar');
        exit();
    }
}