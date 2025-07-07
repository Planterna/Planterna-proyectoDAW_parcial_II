<?php
<<<<<<< HEAD
require_once 'model/dao/RepuestosDAO.php';
require_once 'model/dao/MarcaDAO.php';
require_once 'model/dao/ModeloDAO.php';
require_once 'model/dto/RepuestoDTO.php';
require_once 'util/functions.php';

class RepuestosController
{
    private $model;
    private $modelMarca;
    private $modelModelo;

    public function __construct()
    {
        $this->model = new RepuestosDAO();
        $this->modelMarca = new MarcaDAO();
        $this->modelModelo = new ModeloDAO();
    }

    public function index()
    {
        $resultados = $this->model->selectAll("");
        $titulo = "Lista de repuestos";
        require_once VREPUESTOS . 'listar.php';
    }

    public function view_new()
    {
        $marcas = $this->modelMarca->selectAll("");
        $idMarca = isset($_POST['marca']) ? (int)trim($_POST['marca']) : null;
        $modelos = $idMarca ? $this->modelModelo->filterModel($idMarca) : [];

        $datosFormulario = [
            'nombre' => $_POST['nombre'] ?? '',
            'descripcion' => $_POST['descripcion'] ?? '',
            'precio' => $_POST['precio'] ?? '',
            'stock' => $_POST['stock'] ?? '',
            'tipoRepuesto' => $_POST['tipoRepuesto'] ?? '',
            'marca' => $_POST['marca'] ?? '',
            'modelo' => $_POST['modelo'] ?? null,
            'estado' => $_POST['estado'] ?? 0,
        ];

        $titulo = "Registrar Producto";
        require_once VREPUESTOS . 'registrar.php';
    }

    public function new()
    {
        $nombre = $_POST['nombre'] ?? '';
        $descripcion = $_POST['descripcion'] ?? '';
        $precio = $_POST['precio'] ?? '';
        $stock = $_POST['stock'] ?? '';
        $tipoRepuesto = $_POST['tipoRepuesto'] ?? '';
        $marca = $_POST['marca'] ?? '';
        $modelo = $_POST['modelo'] ?? '';
        $estado = isset($_POST['estado']) ? 1 : 0;

        $errores = [];

        if (!validarNombre($nombre)) $errores['nombre'] = "El nombre es obligatorio y debe tener entre 3 y 100 caracteres válidos.";
        if (!validarDescripcion($descripcion)) $errores['descripcion'] = "La descripción es obligatoria y debe tener hasta 255 caracteres.";
        if (!validarPrecio($precio)) $errores['precio'] = "El precio debe ser un número positivo válido.";
        if (!validarStock($stock)) $errores['stock'] = "El stock debe ser un número entero mayor o igual a 0.";
        if (!validarTipoRepuesto($tipoRepuesto)) $errores['tipoRepuesto'] = "Seleccione un tipo de repuesto válido.";
        if (!validarMarca($marca)) $errores['marca'] = "Seleccione una marca válida.";
        if (!validarModelo($modelo)) $errores['modelo'] = "Seleccione un modelo válido.";

        if (!empty($errores)) {
            $marcas = $this->modelMarca->selectAll("");
            $modelos = !empty($marca) ? $this->modelModelo->filterModel((int)$marca) : [];
            $datosFormulario = compact('nombre', 'descripcion', 'precio', 'stock', 'tipoRepuesto', 'marca', 'modelo', 'estado');
            require_once VREPUESTOS . 'registrar.php';
            return;
        }

        $repuesto = new RepuestoDTO();
        $repuesto->setNombre($nombre);
        $repuesto->setDescripcion($descripcion);
        $repuesto->setPrecio(floatval($precio));
        $repuesto->setStock(intval($stock));
        $repuesto->setTipoRepuesto($tipoRepuesto);
        $repuesto->setIdMarca((int)$marca);
        $repuesto->setIdModelo((int)$modelo);
        $repuesto->setEstado($estado);

        $exito = $this->model->insert($repuesto);

        $this->redirectWithMessage(
            $exito,
            "Repuesto registrado correctamente",
            "Error al registrar el repuesto",
            "index.php?c=repuestos&f=view_new"
        );
    }

    public function view_edit()
    {
        $id = trim($_GET['id']);
        $rep = $this->model->selectOne($id);

        $marcas = $this->modelMarca->selectAll("");
        $modelos = $this->modelModelo->filterModel($rep['rep_idMarca']);

        $datosFormulario = [
            'id' => $rep['rep_id'],
            'nombre' => $rep['rep_nombre'],
            'descripcion' => $rep['rep_descripcion'],
            'precio' => $rep['rep_precio'],
            'stock' => $rep['rep_stock'],
            'tipoRepuesto' => $rep['rep_tipoRepuesto'],
            'marca' => $rep['rep_idMarca'],
            'modelo' => $rep['rep_idModelo'],
            'estado' => $rep['rep_estado'],
            'imagen_actual' => $rep['rep_imagen'] ?? '',
        ];

        $errores = [];
        $titulo = "Editar Repuesto";
        require_once VREPUESTOS . "edit.php";
    }

    public function edit()
    {
        $id = $_POST['id'] ?? '';
        $nombre = $_POST['nombre'] ?? '';
        $descripcion = $_POST['descripcion'] ?? '';
        $precio = $_POST['precio'] ?? '';
        $stock = $_POST['stock'] ?? '';
        $marca = $_POST['marca'] ?? '';
        $modelo = $_POST['modelo'] ?? '';
        $tipoRepuesto = $_POST['tipoRepuesto'] ?? '';
        $estado = isset($_POST['estado']) ? 1 : 0;

        $errores = [];

        if (!validarNombre($nombre)) $errores['nombre'] = "El nombre es obligatorio y debe tener entre 3 y 100 caracteres.";
        if (!validarDescripcion($descripcion)) $errores['descripcion'] = "La descripción es obligatoria y válida.";
        if (!validarPrecio($precio)) $errores['precio'] = "El precio debe ser un número positivo válido.";
        if (!validarStock($stock)) $errores['stock'] = "El stock debe ser un número entero mayor o igual a 0.";
        if (!validarMarca($marca)) $errores['marca'] = "Seleccione una marca válida.";
        if (!validarModelo($modelo)) $errores['modelo'] = "Seleccione un modelo válido.";
        if (!validarTipoRepuesto($tipoRepuesto)) $errores['tipoRepuesto'] = "Seleccione un tipo válido.";

        if (!empty($errores)) {
            $marcas = $this->modelMarca->selectAll("");
            $modelos = !empty($marca) ? $this->modelModelo->filterModel((int)$marca) : [];
            $datosFormulario = compact('id', 'nombre', 'descripcion', 'precio', 'stock', 'tipoRepuesto', 'marca', 'modelo', 'estado');
            $titulo = "Editar Repuesto";
            require_once VREPUESTOS . "edit.php";
            return;
        }

        $repuesto = new RepuestoDTO();
        $repuesto->setId((int)$id);
        $repuesto->setNombre($nombre);
        $repuesto->setDescripcion($descripcion);
        $repuesto->setPrecio(floatval($precio));
        $repuesto->setStock(intval($stock));
        $repuesto->setTipoRepuesto($tipoRepuesto);
        $repuesto->setIdMarca((int)$marca);
        $repuesto->setIdModelo((int)$modelo);
        $repuesto->setEstado($estado);

        $exito = $this->model->update($repuesto);

        $this->redirectWithMessage(
            $exito,
            "Repuesto actualizado correctamente",
            "Error al actualizar el repuesto",
            "index.php?c=repuestos&f=index"
        );
    }

    public function delete()
    {
      /*  session_start();
        $this->validarAcceso([1, 2]); */

        $id = htmlentities(trim($_GET['id']));
        $exito = $this->model->delete($id);

        $this->redirectWithMessage(
            $exito,
            "Repuesto Eliminado Correctamente",
            "Error al eliminar repuesto",
            "index.php?c=repuestos&f=index"
        );
    }

    public function search()
    {
        $parametro = htmlspecialchars($_POST['b']);
        $resultados = $this->model->selectAll($parametro);
        require_once VREPUESTOS . 'listar.php';
    }

    public function populate()
    {
        $repuesto = new RepuestoDTO();
        $repuesto->setId(isset($_POST['id']) ? htmlentities(trim($_POST['id'])) : null);
        $repuesto->setNombre(htmlentities(trim($_POST['nombre'])));
        $repuesto->setDescripcion(htmlentities(trim($_POST['descripcion'])));
        $repuesto->setPrecio(htmlentities(trim($_POST['precio'])));
        $repuesto->setStock(htmlentities(trim($_POST['stock'])));
        $repuesto->setTipoRepuesto(htmlspecialchars(trim($_POST['tipoRepuesto'])));
        $repuesto->setIdMarca((int)trim($_POST['marca']));
        $repuesto->setIdModelo((int)trim($_POST['modelo']));
        $estado = isset($_POST['estado']) ? 1 : 0;
        $repuesto->setEstado($estado);
        return $repuesto;
    }

    public function redirectWithMessage($exito, $exitoMsg, $errorMsg, $url)
    {
        if (!isset($_SESSION)) session_start();
        $_SESSION['mensaje'] = $exito ? $exitoMsg : $errorMsg;
        $_SESSION['color'] = $exito ? "primary" : "danger";
        header("Location: " . trim($url));
        exit();
    }

    // private function validarAcceso(array $roles)
    // {
    //     session_start();
    //     if (!isset($_SESSION['loggedIn']) || $_SESSION['loggedIn'] !== true) {
    //         header("Location: index.php?c=index&f=index");
    //     }
    //     if (!in_array($_SESSION['rol'], $roles)) {
    //         $_SESSION['mensaje'] = "Acceso denegado";
    //         $_SESSION['color'] = "danger";
    //         header("Location: index.php?c=index&f=index");
    //         exit();
    //     }
    // }
}
=======
    require_once 'model/dao/ProductosDAO.php';
    class RepuestosController {

        private $model;

        public function __construct() {
            $this->model = new ProductosDAO();
        }

        public function index() {
            require_once VPRODUCTOS .'main.php';
        }

    }


?>
>>>>>>> 40858e616dc5bfcb5344e83b7d8a631c8cd99cfc
