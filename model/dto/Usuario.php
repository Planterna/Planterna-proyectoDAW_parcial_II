<!--autor: John Steven Quijije Tovar-->

<?php

class Usuario {
    private $id_user; 
    private $nombre;
    private $cedula;
    private $correo;
    private $telefono;
    private $password;
    private $rol;
    private $estado; 
    private $notificaciones; 
    private $fecha_creacion; 

    public function __construct() {}

    function getIdUser() { return $this->id_user; }
    function getNombre() { return $this->nombre; }
    function getCedula() { return $this->cedula; }
    function getCorreo() { return $this->correo; }
    function getTelefono() { return $this->telefono; }
    function getPassword() { return $this->password; }
    function getRol() { return $this->rol; }
    function getEstado() { return $this->estado; } 
    function getRecibirInfo() { return $this->notificaciones; } 
    function getFechaCreacion() { return $this->fecha_creacion; } 

    function setIdUser($id_user) { $this->id_user = $id_user; }
    function setNombre($nombre) { $this->nombre = $nombre; }
    function setCedula($cedula) { $this->cedula = $cedula; }
    function setCorreo($correo) { $this->correo = $correo; }
    function setTelefono($telefono) { $this->telefono = $telefono; }
    function setPassword($password) { $this->password = $password; }
    function setRol($rol) { $this->rol = $rol; }
    function setEstado($estado) { $this->estado = $estado; } 
    function setRecibirInfo($notificaciones) { $this->notificaciones = $notificaciones; } 
    function setFechaCreacion($fecha_creacion) { $this->fecha_creacion = $fecha_creacion; } 
}
?>