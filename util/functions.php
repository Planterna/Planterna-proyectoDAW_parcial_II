<?php

  
  class functionUtil{

    public function __construct() {}    
  function redirectWithMessage($exito, $exitoMsg, $errMsg, $redirectUrl){
        if(!isset($_SESSION)) session_start();
        $_SESSION['mensaje']= ($exito )?$exitoMsg:$errMsg;
        $_SESSION['color']= ($exito )?'primary':'danger';

       // echo ($exito)?$exitoMsg:$errMsg;
       header("Location: $redirectUrl");
    }

    function validatorSession($rol){
      if (empty($_SESSION['rol'] && $_SESSION['rol'] !== '1')|| $_SESSION['rol' !== '2']|| $_SESSION['rol' !== '3'] ){

      }
    }

  }
?>