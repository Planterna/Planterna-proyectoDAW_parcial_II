<?php
//autor:dean

require_once 'config/Conexion.php';
require_once 'model/dto/Cotizacion.php';

class CotizacionDAO {
    private $conexion;

    public function __construct() {
        $this->conexion = Conexion::getConexion();
    }

    public function listarCotizaciones() {
        $sql = "SELECT id_cotizacion, nombre_cliente, correo_cliente, telefono_cliente, descripcion_servicio, estado, fecha_solicitud
                FROM cotizacion
                ORDER BY fecha_solicitud DESC";
        try {
            $stmt = $this->conexion->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $cotizaciones = [];
            foreach ($result as $row) {
                $cotizacion = new Cotizacion(
                    $row['id_cotizacion'],
                    $row['nombre_cliente'],
                    $row['correo_cliente'],
                    $row['telefono_cliente'],
                    $row['descripcion_servicio'],
                    $row['estado'],
                    $row['fecha_solicitud'],
                    null
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
        $sql = "SELECT id_cotizacion, nombre_cliente, correo_cliente, telefono_cliente, descripcion_servicio, estado, fecha_solicitud
                FROM cotizacion
                WHERE id_cotizacion = :id_cotizacion";
        try {
            $stmt = $this->conexion->prepare($sql);
            $stmt->bindParam(':id_cotizacion', $id_cotizacion, PDO::PARAM_INT);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($row) {
                return new Cotizacion(
                    $row['id_cotizacion'],
                    $row['nombre_cliente'],
                    $row['correo_cliente'],
                    $row['telefono_cliente'],
                    $row['descripcion_servicio'],
                    $row['estado'],
                    $row['fecha_solicitud'],
                    null
                );
            }
            return null; 
        } catch (PDOException $e) {
            error_log("Error al obtener cotización por ID: " . $e->getMessage());
            return null; 
        }
    }

    public function registrarCotizacion(Cotizacion $cotizacion) {
        $sql = "INSERT INTO cotizacion (nombre_cliente, correo_cliente, telefono_cliente, descripcion_servicio, estado)
                VALUES (:nombre_cliente, :correo_cliente, :telefono_cliente, :descripcion_servicio, :estado)";
        try {
            $stmt = $this->conexion->prepare($sql);
            $stmt->bindValue(':nombre_cliente', $cotizacion->getClienteNombre());
            $stmt->bindValue(':correo_cliente', $cotizacion->getClienteCorreo());
            $stmt->bindValue(':telefono_cliente', $cotizacion->getClienteTelefono());
            $stmt->bindValue(':descripcion_servicio', $cotizacion->getDescripcionServicio());
            $stmt->bindValue(':estado', $cotizacion->getEstado());
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Error al registrar cotización: " . $e->getMessage());
            return false; 
        }
    }

    public function actualizarCotizacion(Cotizacion $cotizacion) {
        $sql = "UPDATE cotizacion SET
                    nombre_cliente = :nombre_cliente,
                    correo_cliente = :correo_cliente,
                    telefono_cliente = :telefono_cliente,
                    descripcion_servicio = :descripcion_servicio,
                    estado = :estado
                WHERE id_cotizacion = :id_cotizacion";
        try {
            $stmt = $this->conexion->prepare($sql);
            $stmt->bindValue(':nombre_cliente', $cotizacion->getClienteNombre());
            $stmt->bindValue(':correo_cliente', $cotizacion->getClienteCorreo());
            $stmt->bindValue(':telefono_cliente', $cotizacion->getClienteTelefono());
            $stmt->bindValue(':descripcion_servicio', $cotizacion->getDescripcionServicio());
            $stmt->bindValue(':estado', $cotizacion->getEstado());
            $stmt->bindValue(':id_cotizacion', $cotizacion->getIdCotizacion(), PDO::PARAM_INT);
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Error al actualizar cotización: " . $e->getMessage());
            return false; 
        }
    }

    public function eliminarCotizacion($id_cotizacion) {
        $sql = "DELETE FROM cotizacion WHERE id_cotizacion = :id_cotizacion";
        try {
            $stmt = $this->conexion->prepare($sql);
            $stmt->bindParam(':id_cotizacion', $id_cotizacion, PDO::PARAM_INT);
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Error al eliminar cotización: " . $e->getMessage());
            return false; 
        }
    }

    public function cambiarEstadoCotizacion($id_cotizacion, $nuevo_estado) {
        $sql = "UPDATE cotizacion SET estado = :estado WHERE id_cotizacion = :id_cotizacion";
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