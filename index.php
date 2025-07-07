<?php
// Implementación del patrón de diseño FrontController
// va a recibir dos parámetros: c para el nombre del controlador
// y f para la función del controlador que queremos ejecutar

require_once 'config/config.php';

// Leer parámetros
// <a href="index.php?c=productos&f=view_form">Agregar Producto</a>
$controlador = (!empty($_REQUEST['c'])) ? htmlentities($_REQUEST['c']) : CONTROLADOR_PRINCIPAL;

// Capitalizar primera letra y añadir "Controller"
$controlador = ucwords(strtolower($controlador)) . "Controller";
// Ejemplo: IndexController

$funcion = (!empty($_REQUEST['f'])) ? htmlentities($_REQUEST['f']) : FUNCION_PRINCIPAL;
// Ejemplo: index

require_once 'controller/' . $controlador . '.php';

// Crear el objeto controlador
$cont = new $controlador();

// Llamada a la función del controlador
$cont->$funcion();
?>
