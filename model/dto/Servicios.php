<!--autor: Jonathan Alejandro Baquerizo-->

<?php
// dto data transfer object
class Servicio {
    //properties
    private $id, $nombre, $cedula, $telefono, $correo, 
    $marcaVehiculo, $placaVehiculo,$tipoServicio, $id_user, $id_tecnico,
    $estado, $fechaCreacion ,$fechaModificacion;

    function __construct() {
        
    }

    // Methods get
    function getId() {
        return $this->id;
    }

   
    function getNombre() {
        return $this->nombre;
    }

    function getcedula() {
        return $this->cedula;
    }

    function gettelefono() {
        return $this->telefono;
    }

    function getcorreo() {
        return $this->correo;
    }

    function getTipoServicio() {
        return $this->tipoServicio;
    }

    function getId_user() {
        return $this->id_user;
    }

    function getId_tecnico() {
        return $this->id_tecnico;
    }

    function getmarcaVehiculo() {
        return $this->marcaVehiculo;
    }

    function getplacaVehiculo() {
        return $this->placaVehiculo;
    }

    function getfechaModificacion() {
        return $this->fechaModificacion;
    }

    function getEstado() {
        return $this->estado;
    }

    function getfechaCreacion() {
        return $this->fechaCreacion;
    }

    // Methods set

    function setNombre($nombre) {
        $this->nombre = $nombre;
    }
    function setcedula($des) {
        $this->cedula = $des;
    }
  
    function settelefono($telefono) {
        $this->telefono = $telefono;
    }

    function setcorreo($correo) {
        $this->correo = $correo;
    }
    function setTipoServicio($tipoServicio) {
        $this->tipoServicio = $tipoServicio;
    }
    function setId_user($id_user) {
        $this->id_user = $id_user;
    }

    function setId_tecnico($id_tecnico) {
        $this->id_tecnico = $id_tecnico;
    }

    function setmarcaVehiculo($marcaVehiculo) {
        $this->marcaVehiculo = $marcaVehiculo;
    }


    function setplacaVehiculo($placaVehiculo) {
        $this->placaVehiculo = $placaVehiculo;
    }

    function setfechaModificacion($fechaModificacion) {
        $this->fechaModificacion = $fechaModificacion;
    }

    function setEstado($estado) {
        $this->estado = $estado;
    }
    function setfechaCreacion($fechaCreacion) {
        $this->fechaCreacion = $fechaCreacion;
    }
    
    
}
