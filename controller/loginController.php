<?php
// Autor: John Steven Quijije Tovar

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
        $this->model   = new UsuariosDAO();
        $this->util    = new functionValidationsUser();
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

    public function dashboard()
    {
        session_start();
        if (!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] !== true) {
            header("Location: index.php?c=login&f=index");
            exit();
        }
        require_once VLOGIN . 'dashboard.php';
    }

    public function dashboardAdmin()
    {
        session_start();
        if (!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] !== true) {
            header("Location: index.php?c=login&f=index");
            exit();
        }
        require_once VLOGIN . 'dashboardAdmin.php';
    }

    public function registrar()
    {

        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
        $isAdmin = isset($_SESSION['loggedIn']) && $_SESSION['loggedIn'] === true && $_SESSION['rol'] == 3;


        $nombre = $_POST['nombre'] ?? '';
        $cedula = $_POST['cedula'] ?? '';
        $correo = $_POST['correo'] ?? '';
        $telefono = $_POST['telefono'] ?? '';
        $password = $_POST['password'] ?? '';
        $confirmar_password = $_POST['confirmar_password'] ?? '';
        $notificaciones = isset($_POST['notificaciones']) ? 1 : 0;
        $rol = $_POST['rol'] ?? 1;
        $estado = 1;


        $errores = $this->util->addError(
            $this->util->validateName($nombre),
            $this->util->validateCedula($cedula),
            $this->util->validateEmail($correo),
            $this->util->validateTelefono($telefono),
            $this->util->validatePassword($password)
        );

        $errores_list = ($errores === "No hay errores.") ? [] : explode("<br>", str_replace(["Errores: <br>", ". "], "", $errores));

        if ($password !== $confirmar_password) {
            $errores_list[] = "Las contraseñas no coinciden.";
        }
        if ($this->model->buscarPorCedula($cedula)) {
            $errores_list[] = "La cédula ya está registrada.";
        }
        if ($this->model->buscarPorCorreo($correo)) {
            $errores_list[] = "El correo electrónico ya está registrado.";
        }


        if (!empty($errores_list)) {
            $urlError = $isAdmin ? "index.php?c=login&f=dashboardAdmin"
                                 : "index.php?c=login&f=registro";
            $this->message->redirectWithMessage(
                false,
                "",
                "Error en los datos:<br>" . implode("<br>", $errores_list),
                $urlError
            );
            exit;
        }


        $usuarioObj = new Usuario();
        $usuarioObj->setNombre(htmlentities($nombre));
        $usuarioObj->setCedula(htmlentities($cedula));
        $usuarioObj->setCorreo(htmlentities($correo));
        $usuarioObj->setTelefono(htmlentities($telefono));
        $usuarioObj->setPassword(password_hash($password, PASSWORD_BCRYPT));
        $usuarioObj->setRol($rol);
        $usuarioObj->setEstado($estado);
        $usuarioObj->setRecibirInfo($notificaciones);

        $exito = $this->model->insert($usuarioObj);


        if ($exito) {
            $urlOk = $isAdmin ? "index.php?c=login&f=dashboardAdmin"
                              : $this->urlDashboardPorRol($rol);
            $this->message->redirectWithMessage(true, "¡Usuario registrado exitosamente!", "", $urlOk);
        } else {
            $urlFail = $isAdmin ? "index.php?c=login&f=dashboardAdmin"
                                : "index.php?c=login&f=index";
            $this->message->redirectWithMessage(false, "", "Error al registrar usuario. Inténtalo de nuevo.", $urlFail);
        }
    }

    public function validar()
    {
        $input_usuario = $_POST['usuario'] ?? '';
        $input_clave   = $_POST['clave'] ?? '';
        $usuario_data  = null;

        $esCedulaValida = $this->util->validateCedula($input_usuario);
        if ($esCedulaValida === "success") {
            $usuario_data = $this->model->buscarPorCedula($input_usuario);
        }

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

            setcookie("usuario", $_SESSION['nombre'], time() + (86400 * 30), "/");

            $this->message->redirectWithMessage(
                true,
                "¡Bienvenido " . $_SESSION['nombre'] . "!",
                "",
                "index.php?c=login&f=dashboard"
            );
        } else {
            $this->message->redirectWithMessage(
                false,
                "",
                "Credenciales incorrectas. Verifique su usuario/correo y contraseña.",
                "index.php?c=login&f=index"
            );
        }
    }

    public function listarUsuarios()
    {
        $this->checkSession();
        if ($_SESSION['rol'] != 3) {
            header("Location: index.php?c=login&f=index");
            exit();
        }

        $rolFiltro  = $_POST['rolFiltro']  ?? '';
        $textoBuscar = trim($_POST['q'] ?? '');   

        $usuarios = $this->model->obtenerTodos($rolFiltro, $textoBuscar);


        $this->rolFiltro  = $rolFiltro;
        $this->textoBuscar = $textoBuscar;
        require_once VLOGIN . 'ListarUsuarios.php';
    }


    public function cambiarEstadoUsuario()
    {
        $this->checkSession();
        if ($_SESSION['rol'] != 3) exit();

        $id     = (int)($_POST['id']     ?? 0);
        $estado = (int)($_POST['estado'] ?? 0);

        $this->model->cambiarEstado($id, $estado);
        header("Location: index.php?c=login&f=listarUsuarios");
    }

    private function checkSession()
    {
        if (session_status() === PHP_SESSION_NONE) session_start();
        if (empty($_SESSION['loggedIn'])) {
            header("Location: index.php?c=login&f=index");
            exit();
        }
    }




    public function logout()
    {
        session_start();
        session_destroy();
        setcookie("usuario", "", time() - 3600, "/");
        header("Location: index.php?c=login&f=index");
        exit();
    }

    // Puedes agregar aquí la función urlDashboardPorRol si no existe
    private function urlDashboardPorRol($rol) {
        switch ($rol) {
            case 3:
                return "index.php?c=login&f=dashboardAdmin";
            default:
                return "index.php?c=login&f=dashboard";
        }
    }
}





