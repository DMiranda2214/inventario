<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\View;
use App\Utils\Alert;
use App\Models\CategoriaModel;

class CategoriasController extends Controller {
    private $categoriaModel;

    public function __construct() {
        if(!isset($_SESSION['username'])) {
            header('Location: /inventario/public');
        }
        $this->categoriaModel = new CategoriaModel();
    }

    public function index() {
        $GLOBALS['PAGE'] = 'categorias';
        View::load('index');
    }

    public function agregarCategoria() {
        $GLOBALS['PAGE'] = 'categorias';
        $GLOBALS['SECTION'] = 'agregarCategoria';
        View::load('index');
    }

    public function editarCategoria() {
        $data = ['id' => $_GET['cat_id']];
        $GLOBALS['PAGE'] = 'categorias';
        $GLOBALS['SECTION'] = 'editarCategoria';
        View::load('index', $data);
    }

    public function eliminarCategoria() {
        Alert::showDelete('/inventario/public/Categorias/delete?cat_id='.$_GET['cat_id'].'','/inventario/public/categorias');
    }

    public function get() {
        $categorias = $this->categoriaModel->getAllCategories();
        return $categorias;
    }

    public function getById($id) {
        $categorias = $this->categoriaModel->getCategoryById($id);
        return $categorias;
    }

    public function insert(){
        $data = [
            'cat_nombre'=> $_POST['cat_nombre'],
            'cat_descripcion' => $_POST['cat_descripcion']
        ];
        $categoria = $this->categoriaModel->insertCategory($data);
        Alert::showSuccess('Nueva Categoria','Ingresado Correctamente','/inventario/public/categorias');
    }

    public function edit() {
        $data = [
            'cat_id' => $_POST['cat_id'],
            'cat_nombre' => $_POST['cat_nombre'],
            'cat_descripcion' => $_POST['cat_descripcion']
        ];
        $this->categoriaModel->updateCategory($data);
        Alert::showSuccess('Categoria Actualizada','Actualizado Correctamente','/inventario/public/categorias');
    }

    public function delete() {
        $this->categoriaModel->deleteCategory($_GET['cat_id']);
        Alert::showSuccess('Categoria Eliminada','Eliminado Correctamente','/inventario/public/categorias');
    }
}
?>