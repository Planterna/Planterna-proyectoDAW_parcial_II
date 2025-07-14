<?php
//Autor: Mero Araujo Jeremy
function redirectWithMessage($exito, $exitoMsg, $errMsg, $redirectUrl){
        if(!isset($_SESSION)) session_start();
        $_SESSION['mensaje']= ($exito)?$exitoMsg:$errMsg;
        $_SESSION['color']= ($exito)?'primary':'danger';

       header("Location: $redirectUrl");
    }


function validarNombre($nombre){
    $nombre = trim($nombre);
    return preg_match('/^[\p{L}\p{N} \-áéíóúÁÉÍÓÚñÑ]{3,40}$/u', $nombre) === 1;
}

function validarDescripcion($descripcion){
    $descripcion = trim($descripcion);
    return preg_match('/^[\p{L}\p{N} .,;:!¡¿?\'"()\-]{1,100}$/u', $descripcion) === 1;
}

function validarPrecio($precio){
    if (!preg_match('/^\d+(\.\d{1,2})?$/', $precio)) return false;
    return floatval($precio) > 0;
}

function validarStock($stock){
    return ctype_digit($stock) && intval($stock) >= 0;
}

function validarMarca($marca){
    return ctype_digit($marca) && intval($marca) > 0;
}

function validarModelo($modelo){
    return ctype_digit($modelo) && intval($modelo) > 0;
}

function validarTipoRepuesto($tipoRepuesto){
    $tiposValidos = ['Original', 'Generico', 'Reacondicionado'];
    return in_array($tipoRepuesto, $tiposValidos, true);
}

function validarSesion() {
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }

    if (!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] !== true) {
        $_SESSION['mensaje'] = 'Debe iniciar sesión!';
        $_SESSION['color'] = 'danger';
        header("Location: index.php?c=login&f=index");
        exit();
    }
}


function validarAcceso1(array $roles){
    if(!isset($_SESSION['rol'])|| !in_array($_SESSION['rol'], $roles)){
        $_SESSION['mensaje'] = 'Acceso no permitido';
        $_SESSION['color'] = 'danger';
        header("Location: index.php?c=Tecnico&f=info");
        exit();
    }
}

function validarAcceso(array $roles){
    if(!isset($_SESSION['rol'])|| !in_array($_SESSION['rol'], $roles)){
        $_SESSION['mensaje'] = 'Acceso no permitido';
        $_SESSION['color'] = 'danger';
        header("Location: index.php?c=Repuestos&f=index");
        exit();
    }
}


?>