    <?php
    //Implementación del patrón de diseño FrontController
    //va a recibir dos parametros c para el nombre del controlador
    // y f para la funcion del controlador que queremos ejecutar
    require_once 'config/config.php';
        // leer parametros
        // <a href="index.php?c=productos&f=view_form">Agregar Producto</a>
        $controlador = 
        (!empty($_REQUEST['c']))?htmlentities($_REQUEST['c']):CONTROLADOR_PRINCIPAL;
        // index
        $controlador = ucwords(strtolower($controlador))."Controller";
        //IndexController
        $funcion = (!empty($_REQUEST['f']))?htmlentities($_REQUEST['f']):FUNCION_PRINCIPAL;
        //f= index
        
        require_once 'controller/' . $controlador . '.php';
     
        //Objetivo del front controller
        //crear el controlador
        $cont = new  $controlador();// creacion del objeto controlador 
        //llamada a la funcion
        $cont->$funcion();// llamada a la funcion del controlador
