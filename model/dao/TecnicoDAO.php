<?php

//autor: Anthony Lopez
require_once 'config/Conexion.php';
require_once 'model/dto/Tecnico.php';

class TecnicoDAO {
    private $conexion;

    public function __construct() {
        $this->conexion = Conexion::getConexion();
    }

    public function listarTecnicos() {
        $sql = "SELECT u.id_user, u.nombre, u.cedula, u.correo, u.telefono, u.password, u.rol, u.estado, u.fecha_creacion, u.notificaciones
                FROM usuarios u
                WHERE u.rol = 2 
                ORDER BY u.nombre ASC";
        try {
            $stmt = $this->conexion->prepare($sql);
            $stmt->execute();
            $result = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $tecnicos = [];
            foreach ($result as $row) {
                $tecnico = new Tecnico(
                    $row['id_user'],
                    $row['nombre'],
                    $row['cedula'],
                    $row['correo'],
                    $row['telefono'],
                    $row['password'],
                    $row['rol'],
                    $row['estado'],
                    $row['fecha_creacion'],
                    $row['notificaciones']
                );
                $tecnicos[] = $tecnico;
            }
            return $tecnicos;
        } catch (PDOException $e) {
            error_log("Error al listar técnicos: " . $e->getMessage());
            return [];
        }
    }

    public function obtenerTecnicoPorId($id_user) {
        $sql = "SELECT u.id_user, u.nombre, u.cedula, u.correo, u.telefono, u.password, u.rol, u.estado, u.fecha_creacion, u.notificaciones
                FROM usuarios u
                WHERE u.id_user = :id_user AND u.rol = 2";
        try {
            $stmt = $this->conexion->prepare($sql);
            $stmt->bindParam(':id_user', $id_user, PDO::PARAM_INT);
            $stmt->execute();
            $row = $stmt->fetch(PDO::FETCH_ASSOC);
            if ($row) {
                return new Tecnico(
                    $row['id_user'],
                    $row['nombre'],
                    $row['cedula'],
                    $row['correo'],
                    $row['telefono'],
                    $row['password'],
                    $row['rol'],
                    $row['estado'],
                    $row['fecha_creacion'],
                    $row['notificaciones']
                );
            }
            return null;
        } catch (PDOException $e) {
            error_log("Error al obtener técnico por ID: " . $e->getMessage());
            return null;
        }
    }

    public function registrarTecnico(Tecnico $tecnico) {
        $sql = "INSERT INTO usuarios (nombre, cedula, correo, telefono, password, rol, estado, notificaciones)
                VALUES (:nombre, :cedula, :correo, :telefono, :password, :rol, :estado, :notificaciones)";
        try {
            $stmt = $this->conexion->prepare($sql);
            $stmt->bindValue(':nombre', $tecnico->getNombre());
            $stmt->bindValue(':cedula', $tecnico->getCedula());
            $stmt->bindValue(':correo', $tecnico->getCorreo());
            $stmt->bindValue(':telefono', $tecnico->getTelefono());
            $stmt->bindValue(':password', $tecnico->getPassword());
            $stmt->bindValue(':rol', 2); 
            $stmt->bindValue(':estado', $tecnico->getEstado());
            $stmt->bindValue(':notificaciones', $tecnico->getNotificaciones());
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Error al registrar técnico: " . $e->getMessage());
            return false;
        }
    }

    public function actualizarTecnico(Tecnico $tecnico) {
        $sql = "UPDATE usuarios SET
                    nombre = :nombre, cedula = :cedula, correo = :correo, telefono = :telefono,
                    estado = :estado, notificaciones = :notificaciones
                 WHERE id_user = :id_user AND rol = 2"; 
        try {
            $stmt = $this->conexion->prepare($sql);
            $stmt->bindValue(':nombre', $tecnico->getNombre());
            $stmt->bindValue(':cedula', $tecnico->getCedula());
            $stmt->bindValue(':correo', $tecnico->getCorreo());
            $stmt->bindValue(':telefono', $tecnico->getTelefono());
            $stmt->bindValue(':estado', $tecnico->getEstado());
            $stmt->bindValue(':notificaciones', $tecnico->getNotificaciones());
            $stmt->bindValue(':id_user', $tecnico->getIdUser(), PDO::PARAM_INT);
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Error al actualizar técnico: " . $e->getMessage());
            return false;
        }
    }

    public function eliminarTecnico($id_user) {
        $sql = "UPDATE usuarios SET estado = 0 WHERE id_user = :id_user AND rol = 2";
        try {
            $stmt = $this->conexion->prepare($sql);
            $stmt->bindParam(':id_user', $id_user, PDO::PARAM_INT);
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Error al eliminar (desactivar) técnico: " . $e->getMessage());
            return false;
        }
    }

public function registrarSolicitudSimple($id_tecnico) {
        $sql = "INSERT INTO registro_solicitudes_simples (id_tecnico) VALUES (:id_tecnico)";
        try {
            $stmt = $this->conexion->prepare($sql);
            $stmt->bindValue(':id_tecnico', $id_tecnico, PDO::PARAM_INT);
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Error al registrar solicitud simple: " . $e->getMessage());
            return false;
        }
    }

    public function listarSolicitudesSimples() {
        $sql = "SELECT rs.id_registro, rs.id_tecnico, rs.fecha_solicitud, u.nombre AS nombre_tecnico
                FROM registro_solicitudes_simples rs
                JOIN usuarios u ON rs.id_tecnico = u.id_user
                ORDER BY rs.fecha_solicitud DESC";
        try {
            $stmt = $this->conexion->prepare($sql);
            $stmt->execute();
            return $stmt->fetchAll(PDO::FETCH_ASSOC); 
        } catch (PDOException $e) {
            error_log("Error al listar solicitudes simples: " . $e->getMessage());
            return [];
        }
    }

    public function limpiarTodasSolicitudesSimples() {
        $sql = "DELETE FROM registro_solicitudes_simples";
        try {
            $stmt = $this->conexion->prepare($sql);
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Error al limpiar todas las solicitudes simples: " . $e->getMessage());
            return false;
        }

}
}
?>