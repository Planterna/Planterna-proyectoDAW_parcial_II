<?php
class Repuesto{
    private $id, $nombre, $marca, $modelo, $precio, $stock, $fechaRegistro, $fechaActualizacion, $tipoRepuesto;
    public function __construct(){

    }

    public function getId(){
        return $this->id;
    }
    
    public function getNombre(){
        return $this->nombre;
    }

    public function getMarca(){
        return $this->marca;
    }

    public function getModelo(){
        return $this->modelo;
    }

    public function getPrecio(){
        return $this->precio;
    }
    
    public function getStock(){
        return $this->stock;
    }

    public function getFechaRegistro(){
        return $this->fechaRegistro;
    }

    public function getFechaActualizacion(){
        return $this->fechaActualizacion;
    }

    public function getTipoRepuesto(){
        return $this->tipoRepuesto;
    }

    public function setId($id){
        return $this->id = $id;
    }

    public function setNombre($nombre){
        return $this->nombre = $nombre;
    }
    
    public function setMarca($marca){
        return $this->marca = $marca;
    }

    public function setModelo($modelo){
        return $this->modelo = $modelo;
    }

    public function setPrecio($precio){
        return $this->precio = $precio;

    }

    public function setStock($stock){
        return $this->stock = $stock;
    }

    public function setFechaRegistro($fechaRegistro){
        return $this->fechaRegistro = $fechaRegistro;
    }

    public function setFechaActualizacion($fechaActualizacion){
        return $this->fechaActualizacion = $fechaActualizacion;
    }

    public function setTipoRepuesto($tipoRepuesto){
        return $this->tipoRepuesto = $tipoRepuesto;
    }

    public function __get($atributo){
        if(property_exists('Repuesto', $atributo)){
            return $atributo;
        }
            return null;
    }

    public function __set($valor, $atributo){
        if(property_exists('Repuesto', $atributo)){
            return $this->$atributo = $valor;
        }
            return null;
    }
}
?>