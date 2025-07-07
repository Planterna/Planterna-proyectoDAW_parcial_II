<?php
//autor: Anthony Lopez

class Tecnico { 
    private $id_user;
    private $nombre;
    private $cedula;
    private $correo;
    private $telefono;
    private $password; 
    private $rol; 
    private $estado;
    private $fecha_creacion;
    private $notificaciones;


    public function __construct(
        $id_user = null, $nombre = null, $cedula = null, $correo = null,
        $telefono = null, $password = null, $rol = null, $estado = null,
        $fecha_creacion = null, $notificaciones = null
    ) {
        $this->id_user = $id_user;
        $this->nombre = $nombre;
        $this->cedula = $cedula;
        $this->correo = $correo;
        $this->telefono = $telefono;
        $this->password = $password;
        $this->rol = $rol;
        $this->estado = $estado;
        $this->fecha_creacion = $fecha_creacion;
        $this->notificaciones = $notificaciones;
    }

    public function getIdUser() { return $this->id_user; }
    public function getNombre() { return $this->nombre; }
    public function getCedula() { return $this->cedula; }
    public function getCorreo() { return $this->correo; }
    public function getTelefono() { return $this->telefono; }
    public function getPassword() { return $this->password; }
    public function getRol() { return $this->rol; }
    public function getEstado() { return $this->estado; }
    public function getFechaCreacion() { return $this->fecha_creacion; }
    public function getNotificaciones() { return $this->notificaciones; }

    public function setIdUser($id_user) { $this->id_user = $id_user; }
    public function setNombre($nombre) { $this->nombre = $nombre; }
    public function setCedula($cedula) { $this->cedula = $cedula; }
    public function setCorreo($correo) { $this->correo = $correo; }
    public function setTelefono($telefono) { $this->telefono = $telefono; }
    public function setPassword($password) { $this->password = $password; }
    public function setRol($rol) { $this->rol = $rol; }
    public function setEstado($estado) { $this->estado = $estado; }
    public function setFechaCreacion($fecha_creacion) { $this->fecha_creacion = $fecha_creacion; }
    public function setNotificaciones($notificaciones) { $this->notificaciones = $notificaciones; }
}

?>