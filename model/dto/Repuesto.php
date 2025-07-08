<?php
//Autor: Mero Araujo Jeremcy
class Repuesto {
    private $id;
    private $nombre;
    private $descripcion;
    private $precio;
    private $stock;
    private $tipoRepuesto;             
    private $idMarca;
    private $idModelo;
    private $estado;        
    private $fechaRegistro;
    private $fechaActualizacion;       

    public function __construct() {}

    public function getId()
    {
        return $this->id; 
    }
    public function getNombre() 
    {
        return $this->nombre;
    }
    public function getDescripcion()
    {
        return $this->descripcion;
    }
    public function getPrecio()
    { 
        return $this->precio;
    }
    public function getStock()
    { 
        return $this->stock; 
    }
    public function getTipoRepuesto()
    { 
        return $this->tipoRepuesto; 
    }
    public function getIdMarca() 
    { 
        return $this->idMarca;
    }
    public function getIdModelo() 
    { 
        return $this->idModelo;
    }
    public function getEstado() 
    { 
        return $this->estado;
    }

    public function getFechaRegistro()
    {
        return $this->fechaRegistro;
    }

    public function getFechaActualizacion()
    {
        return $this->fechaActualizacion;
    }
    public function setId($id) 
    { 
        $this->id = $id;
    }
    public function setNombre($nombre) 
    { 
        $this->nombre = $nombre; 
    }
    public function setDescripcion($descripcion)
    { 
        $this->descripcion = $descripcion;
    }
    public function setPrecio($precio)
    { 
        $this->precio = $precio;
    }
    public function setStock($stock) 
    { 
        $this->stock = $stock;
    }
    public function setTipoRepuesto($tipoRepuesto)
    { 
        $this->tipoRepuesto = $tipoRepuesto; 
    }
    public function setIdMarca($idMarca) 
    { 
        $this->idMarca= $idMarca; 
    }
    public function setIdModelo($idModelo) 
    { 
        $this->idModelo = $idModelo; 
    }
    public function setEstado($estado) 
    { 
        $this->estado = $estado; 
    }
    public function setFechaRegistro($fechaRegistro)
    {
        $this->fechaRegistro = $fechaRegistro;
    }
    public function setFechaActualizacion($fechaActualizacion)
    {
        $this->fechaActualizacion = $fechaActualizacion;
    }
    public function __get($atributo) {
        if (property_exists($this, $atributo)) {
            return $this->$atributo;
        }
        return null;
    }

    public function __set($atributo, $valor) {
        if (property_exists($this, $atributo)) {
            $this->$atributo = $valor;
        }
    }
}
?>
