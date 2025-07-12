<?php
//autor:dean
class Cotizacion {
    private $idCotizacion;
    private $clienteNombre;
    private $clienteCorreo;
    private $clienteTelefono;
    private $descripcionServicio;
    private $estado;
    private $fechaSolicitud; 

    public function __construct($idCotizacion, $clienteNombre, $clienteCorreo, $clienteTelefono, $descripcionServicio, $estado, $fechaSolicitud, $fechaActualizacion = null) {
        $this->idCotizacion = $idCotizacion;
        $this->clienteNombre = $clienteNombre;
        $this->clienteCorreo = $clienteCorreo;
        $this->clienteTelefono = $clienteTelefono;
        $this->descripcionServicio = $descripcionServicio;
        $this->estado = $estado;
        $this->fechaSolicitud = $fechaSolicitud; 
    }

    public function getIdCotizacion() {
        return $this->idCotizacion;
    }
    public function getClienteNombre() {
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

    public function getFechaSolicitud() {
        return $this->fechaSolicitud;
    }

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

    public function setFechaSolicitud($fechaSolicitud) {
        $this->fechaSolicitud = $fechaSolicitud;
    }
}