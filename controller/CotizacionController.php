<?php
//autor: Dean Leon

require_once 'config/Conexion.php';
require_once 'model/dto/Cotizacion.php';
require_once 'model/dao/CotizacionDAO.php';
require_once 'util/functionReplacement.php'; 

class CotizacionController {
    private $cotizacionDAO;
    private $conexion;

    public function __construct() {
        $this->conexion = Conexion::getConexion();
        $this->cotizacionDAO = new CotizacionDAO();
    }

    public function info() {
        validarSesion(); 
        validarAcceso([1, 2, 3]); 
        require_once 'view/cotizacion/cotizacion_info.php';
    }

    public function listar() {
        validarSesion();
        validarAcceso([1, 2, 3]); 
        $cotizaciones = $this->cotizacionDAO->listarCotizaciones();
        require_once 'view/cotizacion/cotizacion_list.php';
    }

    public function form_registrar() {
        validarSesion();
        validarAcceso([1, 2, 3]);
        
        $datosFormulario = [
            'cliente_nombre' => $_SESSION['old_input']['cliente_nombre'] ?? '',
            'cliente_correo' => $_SESSION['old_input']['cliente_correo'] ?? '',
            'cliente_telefono' => $_SESSION['old_input']['cliente_telefono'] ?? '',
            'descripcion_servicio' => $_SESSION['old_input']['descripcion_servicio'] ?? '',
        ];
        unset($_SESSION['old_input']);

        require_once 'view/cotizacion/cotizacion_new.php';
    }

    public function registrar() {
        validarSesion();
        validarAcceso([1, 2, 3]); 

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $cliente_nombre = $_POST['cliente_nombre'] ?? '';
            $cliente_correo = $_POST['cliente_correo'] ?? '';
            $cliente_telefono = $_POST['cliente_telefono'] ?? '';
            $descripcion_servicio = $_POST['descripcion_servicio'] ?? '';

            $errores = []; 


            if (empty($cliente_nombre)) {
                $errores['cliente_nombre'] = "El nombre del cliente es obligatorio.";
            } elseif (strlen($cliente_nombre) > 100) {
                $errores['cliente_nombre'] = "El nombre del cliente es demasiado largo (máx. 100 caracteres).";
            }


            if (empty($descripcion_servicio)) {
                $errores['descripcion_servicio'] = "La descripción del servicio es obligatoria.";
            } elseif (strlen($descripcion_servicio) > 65535) { 
                $errores['descripcion_servicio'] = "La descripción del servicio es demasiado larga.";
            }

            if (empty($cliente_correo)) {
                $errores['cliente_correo'] = "El correo electrónico es obligatorio.";
            } elseif (!filter_var($cliente_correo, FILTER_VALIDATE_EMAIL)) {
                $errores['cliente_correo'] = "El formato del correo electrónico no es válido.";
            } elseif (strlen($cliente_correo) > 100) {
                $errores['cliente_correo'] = "El correo electrónico es demasiado largo (máx. 100 caracteres).";
            }

            if (!empty($cliente_telefono) && !preg_match('/^[0-9]{7,20}$/', $cliente_telefono)) {
                $errores['cliente_telefono'] = "El teléfono solo debe contener números (7-20 dígitos).";
            } elseif (strlen($cliente_telefono) > 20) {
                $errores['cliente_telefono'] = "El número de teléfono es demasiado largo (máx. 20 dígitos).";
            }


            if (!empty($errores)) {
                $_SESSION['mensaje'] = implode("<br>", $errores);
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

            redirectWithMessage(
                $this->cotizacionDAO->registrarCotizacion($cotizacion),
                "Cotización registrada exitosamente.",
                "Error al registrar la cotización. Intente de nuevo.",
                "index.php?c=Cotizacion&f=listar"
            );

        } else {
            redirectWithMessage(
                false, 
                "",
                "Método de solicitud no permitido.",
                "index.php?c=Cotizacion&f=listar"
            );
        }
    }

    public function form_editar() {
        validarSesion();
        validarAcceso([1, 3]); 

        if (isset($_GET['id']) && is_numeric($_GET['id'])) {
            $id_cotizacion = $_GET['id'];
            $cotizacion = $this->cotizacionDAO->obtenerCotizacionPorId($id_cotizacion);

            if ($cotizacion) {

                $datosFormulario = [
                    'id_cotizacion' => $_SESSION['old_input']['id_cotizacion'] ?? $cotizacion->getIdCotizacion(),
                    'cliente_nombre' => $_SESSION['old_input']['cliente_nombre'] ?? $cotizacion->getClienteNombre(),
                    'cliente_correo' => $_SESSION['old_input']['cliente_correo'] ?? $cotizacion->getClienteCorreo(),
                    'cliente_telefono' => $_SESSION['old_input']['cliente_telefono'] ?? $cotizacion->getClienteTelefono(),
                    'descripcion_servicio' => $_SESSION['old_input']['descripcion_servicio'] ?? $cotizacion->getDescripcionServicio(),
                    'estado' => $_SESSION['old_input']['estado'] ?? $cotizacion->getEstado(),
                ];
                unset($_SESSION['old_input']);
                require_once 'view/cotizacion/cotizacion_edit.php';
            } else {
                redirectWithMessage(
                    false,
                    "",
                    "Cotización no encontrada.",
                    "index.php?c=Cotizacion&f=listar"
                );
            }
        } else {
            redirectWithMessage(
                false,
                "",
                "ID de cotización no especificado o inválido para editar.",
                "index.php?c=Cotizacion&f=listar"
            );
        }
    }

    public function actualizar() {
        validarSesion();
        validarAcceso([1, 3]); 

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $id_cotizacion = $_POST['id_cotizacion'] ?? null;
            $cliente_nombre = $_POST['cliente_nombre'] ?? '';
            $cliente_correo = $_POST['cliente_correo'] ?? '';
            $cliente_telefono = $_POST['cliente_telefono'] ?? '';
            $descripcion_servicio = $_POST['descripcion_servicio'] ?? '';
            $estado = $_POST['estado'] ?? '';

            $errores = [];
            $estados_validos = ['Pendiente', 'Aceptada', 'Rechazada', 'Completada', 'Cancelada'];

            if (empty($id_cotizacion) || !is_numeric($id_cotizacion)) {
                $errores['id_cotizacion'] = "ID de cotización inválido.";
            }
            if (empty($cliente_nombre)) {
                $errores['cliente_nombre'] = "El nombre del cliente es obligatorio.";
            } elseif (strlen($cliente_nombre) > 100) {
                $errores['cliente_nombre'] = "El nombre del cliente es demasiado largo (máx. 100 caracteres).";
            }

            if (empty($descripcion_servicio)) {
                $errores['descripcion_servicio'] = "La descripción del servicio es obligatoria.";
            } elseif (strlen($descripcion_servicio) > 65535) {
                $errores['descripcion_servicio'] = "La descripción del servicio es demasiado larga.";
            }

            if (empty($cliente_correo)) {
                $errores['cliente_correo'] = "El correo electrónico es obligatorio.";
            } elseif (!filter_var($cliente_correo, FILTER_VALIDATE_EMAIL)) {
                $errores['cliente_correo'] = "El formato del correo electrónico no es válido.";
            } elseif (strlen($cliente_correo) > 100) {
                $errores['cliente_correo'] = "El correo electrónico es demasiado largo (máx. 100 caracteres).";
            }

            if (!empty($cliente_telefono) && !preg_match('/^[0-9]{7,20}$/', $cliente_telefono)) {
                $errores['cliente_telefono'] = "El teléfono solo debe contener números (7-20 dígitos).";
            } elseif (strlen($cliente_telefono) > 20) {
                $errores['cliente_telefono'] = "El número de teléfono es demasiado largo (máx. 20 dígitos).";
            }

            if (!in_array($estado, $estados_validos)) {
                $errores['estado'] = "El estado seleccionado no es válido.";
            }

            if (!empty($errores)) {
                $_SESSION['mensaje'] = implode("<br>", $errores);
                $_SESSION['color'] = "danger";
                $_SESSION['old_input'] = $_POST;
                header('Location: index.php?c=Cotizacion&f=form_editar&id=' . urlencode($id_cotizacion));
                exit();
            }

            $cotizacionExistente = $this->cotizacionDAO->obtenerCotizacionPorId($id_cotizacion);
            if (!$cotizacionExistente) {
                redirectWithMessage(
                    false,
                    "",
                    "Cotización a actualizar no encontrada.",
                    "index.php?c=Cotizacion&f=listar"
                );
            }

            $cotizacion = new Cotizacion(
                $id_cotizacion,
                $cliente_nombre,
                $cliente_correo,
                $cliente_telefono,
                $descripcion_servicio,
                $estado,
                $cotizacionExistente->getFechaCreacion(), 
                null 
            );

            redirectWithMessage(
                $this->cotizacionDAO->actualizarCotizacion($cotizacion),
                "Cotización actualizada exitosamente.",
                "Error al actualizar la cotización. Intente de nuevo.",
                "index.php?c=Cotizacion&f=listar"
            );

        } else {
            redirectWithMessage(
                false,
                "",
                "Método de solicitud no permitido.",
                "index.php?c=Cotizacion&f=listar"
            );
        }
    }

    public function eliminar() {
        validarSesion();
        validarAcceso([1]); 

        if (isset($_GET['id']) && is_numeric($_GET['id'])) {
            $id = $_GET['id'];
            redirectWithMessage(
                $this->cotizacionDAO->eliminarCotizacion($id),
                "Cotización eliminada exitosamente.",
                "Error al eliminar la cotización. Puede que esté asociada a otros registros o que no exista.",
                "index.php?c=Cotizacion&f=listar"
            );
        } else {
            redirectWithMessage(
                false,
                "",
                "ID de cotización no especificado o inválido para eliminar.",
                "index.php?c=Cotizacion&f=listar"
            );
        }
    }

    public function cambiar_estado() {
        validarSesion();
        validarAcceso([1, 2, 3]); 

        $id_cotizacion = $_GET['id'] ?? null;
        $nuevo_estado = $_GET['estado'] ?? null;

        $estados_validos = ['Pendiente', 'Aceptada', 'Rechazada', 'Completada', 'Cancelada'];
        if (empty($id_cotizacion) || !is_numeric($id_cotizacion) || empty($nuevo_estado) || !in_array($nuevo_estado, $estados_validos)) {
            redirectWithMessage(
                false,
                "",
                "Datos inválidos para cambiar el estado de la cotización.",
                "index.php?c=Cotizacion&f=listar"
            );
        }

        redirectWithMessage(
            $this->cotizacionDAO->cambiarEstadoCotizacion($id_cotizacion, $nuevo_estado),
            "Estado de la cotización actualizado a '" . htmlspecialchars($nuevo_estado) . "' exitosamente.",
            "Error al cambiar el estado de la cotización.",
            "index.php?c=Cotizacion&f=listar"
        );
    }
}