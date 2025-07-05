<!--autor: John Steven Quijije Tovar-->

<?php
require_once 'model/dto/Usuario.php';
require_once 'model/dao/UsuariosDAO.php';
require_once 'util/functionValidationsUser.php';
require_once 'util/functions.php';

class LoginController
{
    private $model;
    private $util;
    private $message;

    public function __construct()
    {
        $this->model = new UsuariosDAO();
        $this->util = new functionValidationsUser(); 
        $this->message = new FunctionUtil();
    }

    public function index()
    {

        require_once VLOGIN . 'login.php';
    }

    public function registro()
    {

        require_once VLOGIN . 'registro.php';
    }

    public function registrar()
    {

        $nombre = $_POST['nombre'] ?? '';
        $cedula = $_POST['cedula'] ?? '';
        $correo = $_POST['correo'] ?? '';
        $telefono = $_POST['telefono'] ?? '';
        $password = $_POST['password'] ?? '';
        $confirmar_password = $_POST['confirmar_password'] ?? '';
        $notificaciones = isset($_POST['notificaciones']) ? 1 : 0; 

        
        $rol = 1; 
        $estado = 1; 

        
        $v_nombre = $this->util->validateName($nombre);
        $v_cedula = $this->util->validateCedula($cedula); 
        $v_correo = $this->util->validateEmail($correo);
        $v_telefono = $this->util->validateTelefono($telefono); 
        $v_password = $this->util->validatePassword($password);

        $errores_list = [];

        // Recopilar errores de las validaciones individuales
        if ($v_nombre !== "success") $errores_list[] = $v_nombre;
        if ($v_cedula !== "success") $errores_list[] = $v_cedula;
        if ($v_correo !== "success") $errores_list[] = $v_correo;
        if ($v_telefono !== "success") $errores_list[] = $v_telefono;
        if ($v_password !== "success") $errores_list[] = $v_password;

        // Verificar confirmación de contraseña
        if ($password !== $confirmar_password) {
            $errores_list[] = "Las contraseñas no coinciden.";
        }

        // Verificar si la cédula o el correo ya están registrados
        if ($this->model->buscarPorCedula($cedula)) {
            $errores_list[] = "La cédula ya está registrada.";
        }
        if ($this->model->buscarPorCorreo($correo)) {
            $errores_list[] = "El correo electrónico ya está registrado.";
        }

        // Si hay errores, redirigir con el mensaje
        if (!empty($errores_list)) {
            $this->message->redirectWithMessage(false, "", "Error en los datos: <br>" . implode("<br>", $errores_list), "index.php?c=login&f=registro");
            exit;
        }

        // Crear objeto Usuario DTO
        $usuarioObj = new Usuario();
        $usuarioObj->setNombre(htmlentities($nombre));
        $usuarioObj->setCedula(htmlentities($cedula));
        $usuarioObj->setCorreo(htmlentities($correo));
        $usuarioObj->setTelefono(htmlentities($telefono));
        $usuarioObj->setPassword(password_hash($password, PASSWORD_BCRYPT)); 
        $usuarioObj->setRol($rol); // Rol por defecto
        $usuarioObj->setEstado($estado); // Estado por defecto
        $usuarioObj->setRecibirInfo($notificaciones); // Campo 'notificaciones'

        // Guardar usuario
        $exito = $this->model->insert($usuarioObj);

        $this->message->redirectWithMessage(
            $exito,
            "¡Registro exitoso! Ya puedes iniciar sesión.",
            "Error al registrar usuario. Inténtalo de nuevo.",
            "index.php?c=login&f=index" // Redirigir a la página de inicio de sesión después del registro
        );
    }

    public function validar()
    {
        // El formulario de inicio de sesión usa 'usuario' para cédula/correo y 'clave' para contraseña
        $input_usuario = $_POST['usuario'] ?? '';
        $input_clave = $_POST['clave'] ?? '';

        $usuario_data = null;

        // Validar si el input_usuario es una cédula y buscarla
        $esCedulaValida = $this->util->validateCedula($input_usuario);
        if ($esCedulaValida === "success") {
            $usuario_data = $this->model->buscarPorCedula($input_usuario);
        }

        // Si no se encontró por cédula o no era una cédula, intentar como correo
        // Usamos validateEmail para asegurar que es un formato de email antes de buscar
        if (!$usuario_data) {
             $esCorreoValido = $this->util->validateEmail($input_usuario);
             if ($esCorreoValido === "success") {
                 $usuario_data = $this->model->buscarPorCorreo($input_usuario);
             }
        }

        if ($usuario_data && password_verify($input_clave, $usuario_data['password'])) {
            session_start();
            $_SESSION['id'] = $usuario_data['id_user'];
            $_SESSION['nombre'] = $usuario_data['nombre'];
            $_SESSION['rol'] = $usuario_data['rol'];
            $_SESSION['loggedIn'] = true;

            $this->message->redirectWithMessage(true, "¡Bienvenido " . $_SESSION['nombre'] . "!", "", "index.php");
        } else {
            $this->message->redirectWithMessage(false, "", "Credenciales incorrectas. Verifique su usuario/correo y contraseña.", "index.php?c=login&f=index");
        }
    }

    public function logout()
    {
        session_start();
        session_destroy();
        header("Location: index.php?c=login&f=index");
        exit();
    }
}
?>





