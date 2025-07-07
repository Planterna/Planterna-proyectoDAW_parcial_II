<?php
//autor: [Tu Nombre Completo Aquí]
class Cotizacion {
    private $idCotizacion;
    private $clienteNombre;       // <-- Propiedad en PascalCase
    private $clienteCorreo;
    private $clienteTelefono;
    private $descripcionServicio;
    private $estado;
    private $fechaCreacion;
    private $fechaActualizacion;

    public function __construct($idCotizacion, $clienteNombre, $clienteCorreo, $clienteTelefono, $descripcionServicio, $estado, $fechaCreacion, $fechaActualizacion) {
        $this->idCotizacion = $idCotizacion;
        $this->clienteNombre = $clienteNombre;
        $this->clienteCorreo = $clienteCorreo;
        $this->clienteTelefono = $clienteTelefono;
        $this->descripcionServicio = $descripcionServicio;
        $this->estado = $estado;
        $this->fechaCreacion = $fechaCreacion;
        $this->fechaActualizacion = $fechaActualizacion;
    }

    // Getters
    public function getIdCotizacion() {
        return $this->idCotizacion;
    }
    public function getClienteNombre() { // <-- ESTE MÉTODO DEBE EXISTIR ASÍ
        return $this->clienteNombre;
    }
    public function getClienteCorreo() {
        return $this->clienteCorreo;
    }
    public function getClienteTelefono() {
        return $this->clienteTelefono;
    }
    public function getDescripcionServicio() {
        return $this->descripcionServicio;
    }
    public function getEstado() {
        return $this->estado;
    }
    public function getFechaCreacion() {
        return $this->fechaCreacion;
    }
    public function getFechaActualizacion() {
        return $this->fechaActualizacion;
    }

    // Setters (Si los necesitas para actualizar propiedades individualmente, aunque el constructor ya los asigna)
    public function setIdCotizacion($idCotizacion) {
        $this->idCotizacion = $idCotizacion;
    }
    public function setClienteNombre($clienteNombre) {
        $this->clienteNombre = $clienteNombre;
    }
    public function setClienteCorreo($clienteCorreo) {
        $this->clienteCorreo = $clienteCorreo;
    }
    public function setClienteTelefono($clienteTelefono) {
        $this->clienteTelefono = $clienteTelefono;
    }
    public function setDescripcionServicio($descripcionServicio) {
        $this->descripcionServicio = $descripcionServicio;
    }
    public function setEstado($estado) {
        $this->estado = $estado;
    }
    public function setFechaCreacion($fechaCreacion) {
        $this->fechaCreacion = $fechaCreacion;
    }
    public function setFechaActualizacion($fechaActualizacion) {
        $this->fechaActualizacion = $fechaActualizacion;
    }
}
?>