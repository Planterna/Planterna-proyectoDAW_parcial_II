<!--autor: John Steven Quijije Tovar-->

<?php
require_once 'config/Conexion.php';
require_once 'model/dto/Usuario.php';

class UsuariosDAO {
    private $con;

    public function __construct() {
        $this->con = Conexion::getConexion();
    }

    public function insert($usuario) {
        $sql = "INSERT INTO usuarios (nombre, cedula, correo, telefono, password, rol, estado, notificaciones, fecha_creacion)
                VALUES (:nombre, :cedula, :correo, :telefono, :password, :rol, :estado, :notificaciones, :fecha_creacion)";
        $stmt = $this->con->prepare($sql);

        $stmt->bindValue(":nombre", $usuario->getNombre());
        $stmt->bindValue(":cedula", $usuario->getCedula());
        $stmt->bindValue(":correo", $usuario->getCorreo());
        $stmt->bindValue(":telefono", $usuario->getTelefono());
        $stmt->bindValue(":password", $usuario->getPassword()); 
        $stmt->bindValue(":rol", $usuario->getRol());
        $stmt->bindValue(":estado", $usuario->getEstado());
        $stmt->bindValue(":notificaciones", $usuario->getRecibirInfo());
        $stmt->bindValue(":fecha_creacion", date('Y-m-d H:i:s'));

        try {
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Error en UsuariosDAO::insert: " . $e->getMessage());
            return false;
        }
    }

    public function buscarPorCedula($cedula) {
        
        $sql = "SELECT id_user, nombre, cedula, correo, telefono, password, rol, estado, notificaciones, fecha_creacion FROM usuarios WHERE cedula = :cedula AND estado = 1 LIMIT 1";
        $stmt = $this->con->prepare($sql);
        $stmt->bindValue(":cedula", $cedula);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }

    public function buscarPorCorreo($correo) {
       
        $sql = "SELECT id_user, nombre, cedula, correo, telefono, password, rol, estado, notificaciones, fecha_creacion FROM usuarios WHERE correo = :correo AND estado = 1 LIMIT 1";
        $stmt = $this->con->prepare($sql);
        $stmt->bindValue(":correo", $correo);
        $stmt->execute();
        return $stmt->fetch(PDO::FETCH_ASSOC);
    }


    public function obtenerTodosActivos() {
        $sql = "SELECT id_user, nombre, cedula, correo, telefono, password, rol, estado, notificaciones, fecha_creacion FROM usuarios WHERE estado = 1";
        return $this->con->query($sql)->fetchAll(PDO::FETCH_ASSOC);
    }

    public function eliminarLogico($id) {
        $sql = "UPDATE usuarios SET estado = 0 WHERE id_user = :id_user";
        $stmt = $this->con->prepare($sql);
        $stmt->bindValue(":id_user", $id);
        try {
            return $stmt->execute();
        } catch (PDOException $e) {
            error_log("Error en UsuariosDAO::eliminarLogico: " . $e->getMessage());
            return false;
        }
    }

    public function obtenerTodos($rol = null, $search = '')
    {
        $sql = "SELECT * FROM usuarios WHERE 1=1";
        $params = [];


        if ($rol !== null && $rol !== '') {
            $sql .= " AND rol = :rol";
            $params[':rol'] = $rol;
        }

        if ($search !== '') {
            $sql .= " AND (nombre LIKE :s OR cedula LIKE :s)";
            $params[':s'] = '%'.$search.'%';
        }

        $stmt = $this->con->prepare($sql);
        $stmt->execute($params);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }


    public function cambiarEstado($id, $nuevoEstado) {
        $sql = "UPDATE usuarios SET estado = :estado WHERE id_user = :id_user";
        $stmt = $this->con->prepare($sql);
        $stmt->bindValue(":estado", $nuevoEstado, PDO::PARAM_INT);
        $stmt->bindValue(":id_user", $id,     PDO::PARAM_INT);
        return $stmt->execute();
    }
    

}
?>
