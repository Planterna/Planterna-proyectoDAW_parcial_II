<!--autor: Jonathan Alejandro Baquerizo-->
<?php

class functionValidationsServices
{

    private $regExpText = "/^[a-zA-Z\s]+$/";
    private $regExpNumber = "/^[0-9]{10}$/";
    private $regExpEmail = "/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/";

    private $regExpTextComp = "/^[a-zA-Z\s0-9]{6,9}$/";

    public function __construct() {}

    public function validateName($name)
    {
        if (!empty($name) && !is_null($name)) {
            if (preg_match($this->regExpText, $name)) {
                $msj = "success";
            } else {
                $msj = "El nombre no puede contener caracteres especiales o numeros";
            }
        }else{
            $msj = "El nombre no puede estar vacio";
        }
        return $msj;
    }

    public function validateNumber($number, $isInput)
    {
        if (!empty($number) && !is_null($number)) {
            if (strlen($number) == 10) {
                if (preg_match($this->regExpNumber, $number)) {
                    $msj = "success";
                } else {
                    $msj= "El número de " . $isInput . " no es válido";
                }
            } else {
                $msj= "El número de " . $isInput . " debe tener 10 dígitos";
            }
        }else{
            $msj= "El numero de " . $isInput . " no puede estar vacio";
        }
        return $msj;
    }

    public function validateEmail($email)
    {
        if (!empty($email) && !is_null($email)) {
            if (preg_match($this->regExpEmail, $email)) {
                $msj= "success";
            } else {
                $msj= "El correo no es válido";
            }
        } else {
           $msj= "El correo no puede estar vacio";
        }
        return $msj;
    }

    public function validatePlaca($placa)
    {
        if (!empty($placa) && !is_null($placa)) {
            if (preg_match($this->regExpTextComp, $placa)) {
                $msj= "success";
            } else {
                $msj= "La placa no debe contener más de 8 caracteres alfanuméricos";
            }
        } else {
            $msj= "La placa no puede estar vacía";
        }
        return $msj;
    }

    public function validBasic($parametro, $isInput)
    {
        if (!empty($parametro) && !is_null($parametro)) {
            $msj= "success";
        } else {
            $msj= "El " . $isInput . " no puede ir vacio";
        }
        return $msj;
    }
    public function addError($name, $cedula, $telefono, $correo, $placa, $marca, $tipoServicio)
    {
        $errores = "Errores: <br>";

        if ($name !== "success") $errores .= $name . ". <br>";
        if ($cedula !== "success")  $errores .= $cedula . ". <br>";
        if ($telefono !== "success")  $errores .= $telefono . ". <br>";
        if ($correo !== "success") $errores .= $correo . ". <br>";
        if ($placa !== "success")  $errores .= $placa . ". <br>";
        if ($marca !== "success") $errores .= $marca . ". <br>";
        if ($tipoServicio !== "success") $errores .= $tipoServicio . ". <br>";

        return $errores; 
    }

    public function validationSession(){
        if(!isset($_SESSION)) session_start();

           if (!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] !== true){
            header("Location: index.php?c=login&f=index");
            exit();
            }
            return true;
        }
       
        public function validationRole(){
            if (isset($_SESSION['rol'])) {
                $rol = $_SESSION['rol'];
            } else {
                $rol = 0;
            }
            return $rol;
            
        }
    
}
