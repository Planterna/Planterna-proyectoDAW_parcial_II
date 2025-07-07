<?php
//autor: [Tu Nombre]

// Asegúrate de que BASE_PATH esté definido en config/config.php y sea la ruta raíz de tu proyecto
require_once 'config/Conexion.php';
require_once 'model/dto/Cotizacion.php';

class CotizacionDAO {
    private $conexion;

    public function __construct() {
        $this->conexion = Conexion::getConexion();
    }

    public function listarCotizaciones() {
        $sql = "SELECT id_cotizacion, cliente_nombre, cliente_correo, cliente_telefono, descripcion_servicio, estado, fecha_creacion, fecha_actualizacion
                FROM cotizaciones
                ORDER BY fecha_creacion DESC"; // Ordenar por fecha de creación
        try {
            $stmt = $this->conexion->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $cotizaciones = [];
            foreach ($result as $row) {
                $cotizacion = new Cotizacion(
                    $row['id_cotizacion'],
                    $row['cliente_nombre'],
                    $row['cliente_correo'],
                    $row['cliente_telefono'],
                    $row['descripcion_servicio'],
                    $row['estado'],
                    $row['fecha_creacion'],
                    $row['fecha_actualizacion']
                );
                $cotizaciones[] = $cotizacion;
            }
            return $cotizaciones;
        } catch (PDOException $e) {
            error_log("Error al listar cotizaciones: " . $e->getMessage());
            return [];
        }
    }

    public function obtenerCotizacionPorId($id_cotizacion) {
        $sql = "SELECT id_cotizacion, cliente_nombre, cliente_correo, cliente_telefono, descripcion_servicio, estado, fecha_creacion, fecha_actualizacion
                FROM cotizaciones
                WHERE id_cotizacion = :id_cotizacion";
        try {
            $stmt = $this->conexion->prepare($sql);
            $stmt->bindParam(':id_cotizacion', $id_cotizacion, PDO::PARAM_INT);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($row) {
                return new Cotizacion(
                    $row['id_cotizacion'],
                    $row['cliente_nombre'],
                    $row['cliente_correo'],
                    $row['cliente_telefono'],
                    $row['descripcion_servicio'],
                    $row['estado'],
                    $row['fecha_creacion'],
                    $row['fecha_actualizacion']
                );
            }
            return null;
        } catch (PDOException $e) {
            error_log("Error al obtener cotización por ID: " . $e->getMessage());
            return null;
        }
    }

    public function registrarCotizacion(Cotizacion $cotizacion) {
        $sql = "INSERT INTO cotizaciones (cliente_nombre, cliente_correo, cliente_telefono, descripcion_servicio, estado)
                VALUES (:cliente_nombre, :cliente_correo, :cliente_telefono, :descripcion_servicio, :estado)";
        try {
            $stmt = $this->conexion->prepare($sql);
            $stmt->bindValue(':cliente_nombre', $cotizacion->getClienteNombre());
            $stmt->bindValue(':cliente_correo', $cotizacion->getClienteCorreo());
            $stmt->bindValue(':cliente_telefono', $cotizacion->getClienteTelefono());
            $stmt->bindValue(':descripcion_servicio', $cotizacion->getDescripcionServicio());
            $stmt->bindValue(':estado', $cotizacion->getEstado()); // Estado inicial, por ejemplo 'Pendiente'
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Error al registrar cotización: " . $e->getMessage());
            return false;
        }
    }

    // NUEVO: Actualizar Cotización
    public function actualizarCotizacion(Cotizacion $cotizacion) {
        $sql = "UPDATE cotizaciones SET
                    cliente_nombre = :cliente_nombre,
                    cliente_correo = :cliente_correo,
                    cliente_telefono = :cliente_telefono,
                    descripcion_servicio = :descripcion_servicio,
                    estado = :estado,
                    fecha_actualizacion = NOW()
                WHERE id_cotizacion = :id_cotizacion";
        try {
            $stmt = $this->conexion->prepare($sql);
            $stmt->bindValue(':cliente_nombre', $cotizacion->getClienteNombre());
            $stmt->bindValue(':cliente_correo', $cotizacion->getClienteCorreo());
            $stmt->bindValue(':cliente_telefono', $cotizacion->getClienteTelefono());
            $stmt->bindValue(':descripcion_servicio', $cotizacion->getDescripcionServicio());
            $stmt->bindValue(':estado', $cotizacion->getEstado());
            $stmt->bindValue(':id_cotizacion', $cotizacion->getIdCotizacion(), PDO::PARAM_INT);
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Error al actualizar cotización: " . $e->getMessage());
            return false;
        }
    }

    // NUEVO: Eliminar Cotización
    public function eliminarCotizacion($id_cotizacion) {
        $sql = "DELETE FROM cotizaciones WHERE id_cotizacion = :id_cotizacion";
        try {
            $stmt = $this->conexion->prepare($sql);
            $stmt->bindParam(':id_cotizacion', $id_cotizacion, PDO::PARAM_INT);
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Error al eliminar cotización: " . $e->getMessage());
            return false;
        }
    }

    // NUEVO: Cambiar Estado de Cotización (método específico si solo se quiere cambiar el estado)
    public function cambiarEstadoCotizacion($id_cotizacion, $nuevo_estado) {
        $sql = "UPDATE cotizaciones SET estado = :estado, fecha_actualizacion = NOW() WHERE id_cotizacion = :id_cotizacion";
        try {
            $stmt = $this->conexion->prepare($sql);
            $stmt->bindValue(':estado', $nuevo_estado);
            $stmt->bindValue(':id_cotizacion', $id_cotizacion, PDO::PARAM_INT);
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Error al cambiar estado de cotización: " . $e->getMessage());
            return false;
        }
    }
}
?>