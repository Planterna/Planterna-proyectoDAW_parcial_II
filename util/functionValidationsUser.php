<?php
// autor: John Steven Quijije Tovar

class functionValidationsUser 
{
    
    private $regExpText = "/^[a-zA-ZáéíóúÁÉÍÓÚñÑ\s]+$/";
    private $regExpCedula = "/^[0-9]{10}$/";
    private $regExpTelefono = "/^[0-9]{9,10}$/";
    private $regExpEmail = "/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/";
    private $regExpPassword = "/^(?=.*[A-Za-z])(?=.*\d)(?=.*[@$!%*?&]).{7,}$/";

    public function __construct() {}

    public function validateName($name)
    {
        $name = trim($name);
        if (empty($name)) { return "El nombre completo no puede estar vacío."; }
        if (!preg_match($this->regExpText, $name)) { return "El nombre completo solo puede contener letras y espacios."; }
        return "success";
    }

    public function validateCedula($cedula)
    {
        $cedula = trim($cedula);
        if (empty($cedula)) { return "La cédula no puede estar vacía."; }
        if (!preg_match($this->regExpCedula, $cedula)) { return "La cédula debe tener exactamente 10 dígitos numéricos."; }
        return "success";
    }

    public function validateTelefono($telefono)
    {
        $telefono = trim($telefono);
        if (empty($telefono)) { return "El teléfono no puede estar vacío."; }
        if (!preg_match($this->regExpTelefono, $telefono)) { return "El teléfono debe tener 9 o 10 dígitos numéricos."; }
        return "success";
    }

    public function validateEmail($email)
    {
        $email = trim($email);
        if (empty($email)) { return "El correo electrónico no puede estar vacío."; }
        if (!preg_match($this->regExpEmail, $email)) { return "El formato del correo electrónico no es válido."; }
        return "success";
    }

    public function validatePassword($password)
    {
        if (empty($password)) {
            return "La contraseña no puede estar vacía.";
        }
        if (!preg_match($this->regExpPassword, $password)) {
            return "La contraseña debe tener al menos 7 caracteres, incluyendo una letra, un número y un carácter especial (@$!%*?&).";
        }
        return "success";
    }

    public function addError(...$validationResults)
    {
        $errores = [];
        foreach ($validationResults as $result) {
            if ($result !== "success") {
                $errores[] = $result;
            }
        }

        if (empty($errores)) {
            return "No hay errores.";
        } else {
            return "Errores: <br>" . implode(". <br>", $errores);
        }
    }
}
?>