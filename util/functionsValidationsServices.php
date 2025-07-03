<?php

class functionValidationsServices{

    private $regExpText = "/^[a-zA-Z\s]+$/";
    private $regExpNumber = "/^[0-9]{10}$/"; 
    private $regExpEmail = "/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/";

    private $regExpTextComp = "/^[a-zA-Z\s0-9]{6,9}$/";

    public function __construct() {}

    public function validateName($name){
        if(!empty($name) && !is_null($name)){
        if(preg_match($this->regExpText, $name)){
            return true;
            }
        }
        return false;
    }

    public function validateNumber($number){
        if(!empty($number) && !is_null($number)){
            if(preg_match($this->regExpNumber, $number)){
                return true;
            }
        }
        return false;
    }

    public function validateEmail($email){
        if(!empty($email) && !is_null($email)){
            if(preg_match($this->regExpEmail, $email)){
                return true;
            }
        }

        return false;
    }

}

?>