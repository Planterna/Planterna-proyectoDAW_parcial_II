<?php
require_once 'model/dao/RepuestosDAO.php';
require_once 'model/dao/MarcaDAO.php';
require_once 'model/dao/ModeloDAO.php';
require_once 'model/dto/RepuestoDTO.php';

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

    public function delete()
    {
        $id = htmlentities(trim($_GET['id']));
        $exito = $this->model->delete($id);
        $this->redirectWithMessage(
            $exito,
            "Repuesto Eliminado Correctamente",
            "Error al eliminar repuesto",
            "index.php?c=repuestos&f=index"
        );
    }
    public function index()
    {
        $resultados = $this->model->selectAll("");
        $titulo = "Lista de repuestos";
        require_once VREPUESTOS . 'listar.php';
    }

    public function new()
    {
        $repuesto = new RepuestoDTO();
        $repuesto->setNombre(trim($_POST['nombre']));
        $repuesto->setDescripcion(trim($_POST['descripcion']));
        $repuesto->setPrecio(floatval(trim($_POST['precio'])));
        $repuesto->setStock(intval(trim($_POST['stock'])));
        $repuesto->setTipoRepuesto(trim($_POST['tipoRepuesto']));
        $repuesto->setIdMarca((int)trim($_POST['marca']));
        $repuesto->setIdModelo((int)trim($_POST['modelo']));
        $repuesto->setEstado(isset($_POST['estado']) ? 1 : 0);

        $exito = $this->model->insert($repuesto);
        $this->redirectWithMessage($exito, "Repuesto registrado correctamente", "Error al registrar", "index.php?c=repuestos&f=view_new");
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
        $_SESSION['mensaje'] = ($exito) ? $exitoMsg : $errorMsg;
        $_SESSION['color'] = ($exito) ? "primary" : "danger";
        header("Location: " . trim($url));
        exit();
    }

    public function search()
    {
        $parametro = htmlspecialchars($_POST['b']);
        $resultados = $this->model->selectAll($parametro);
        require_once VREPUESTOS.'listar.php';
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
            'imagen_actual' => '',
        ];

        $titulo = "Editar Repuesto";

        require_once VREPUESTOS . "edit.php";
    }

    public function view_new()
    {
        $marcas = $this->modelMarca->selectAll("");
        $idMarca = isset($_POST['marca']) ? (int)trim($_POST['marca']) : null;

        $modelos = [];
        if ($idMarca) {
            $modelos = $this->modelModelo->filterModel($idMarca);
        }

        $datosFormulario = [
            'nombre' => isset($_POST['nombre']) ? htmlspecialchars(trim($_POST['nombre'])) : '',
            'descripcion' => isset($_POST['descripcion']) ? htmlspecialchars(trim($_POST['descripcion'])) : '',
            'precio' => isset($_POST['precio']) ? htmlspecialchars(trim($_POST['precio'])) : '',
            'stock' => isset($_POST['stock']) ? htmlspecialchars(trim($_POST['stock'])) : '',
            'tipoRepuesto' => isset($_POST['tipoRepuesto']) ? htmlspecialchars(trim($_POST['tipoRepuesto'])) : '',
            'marca' => isset($_POST['marca']) ? htmlspecialchars(trim($_POST['marca'])) : '',
            'modelo' => isset($_POST['modelo']) ? (int)trim($_POST['modelo']) : null,
            'estado' => isset($_POST['estado']) ? htmlspecialchars(trim($_POST['estado'])) : '',
            'imagen_actual' => ''
        ];

        $titulo = "Registrar Producto";
        require_once VREPUESTOS . 'registrar.php';
    }
}
