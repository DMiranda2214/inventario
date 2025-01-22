<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\View;
use App\Utils\Alert;
use App\Models\CategoriaModel;

class CategoriasController extends Controller {
    public function index() {
        if(!isset($_SESSION['username'])) {
            header('Location: /inventario/public');
        }
        $GLOBALS['PAGE'] = 'categorias';
        View::load('index');
    }
    public function agregarCategoria() {
        if(!isset($_SESSION['username'])) {
            header('Location: /inventario/public');
        }
        $GLOBALS['PAGE'] = 'categorias';
        $GLOBALS['SECTION'] = 'agregarCategoria';
        View::load('index');
    }
    public function editarCategoria() {
        if(!isset($_SESSION['username'])) {
            header('Location: /inventario/public');
        }
        $data = ['id' => $_GET['cat_id']];
        $GLOBALS['PAGE'] = 'categorias';
        $GLOBALS['SECTION'] = 'editarCategoria';
        View::load('index', $data);
    }
    public function eliminarCategoria() {
        if(!isset($_SESSION['username'])) {
            header('Location: /inventario/public');
        }
        Alert::showDelete('/inventario/public/Categorias/delete?cat_id='.$_GET['cat_id'].'','/inventario/public/categorias');
    }
    public function get() {
        if(!isset($_SESSION['username'])) {
            header('Location: /inventario/public');
        }
        $categoriaModel = new CategoriaModel;
        $categorias = $categoriaModel->getAllCategories();
        return $categorias;
    }
    public function getById($id) {
        if(!isset($_SESSION['username'])) {
            header('Location: /inventario/public');
        }
        $categoriaModel = new CategoriaModel;
        $categorias = $categoriaModel->getCategoryById($id);
        return $categorias;
    }
    public function insert(){
        if(!isset($_SESSION['username'])) {
            header('Location: /inventario/public');
        }
        $categoriaModel = new CategoriaModel;
        $data = [
            'cat_nombre'=> $_POST['cat_nombre'],
            'cat_descripcion' => $_POST['cat_descripcion']
        ];
        $categoria = $categoriaModel->insertCategory($data);
        Alert::showSuccess('Nueva Categoria','Ingresado Correctamente','/inventario/public/categorias');
    }
    public function edit() {
        if(!isset($_SESSION['username'])) {
            header('Location: /inventario/public');
        }
        $categoriaModel = new CategoriaModel;
        $data = [
            'cat_id' => $_POST['cat_id'],
            'cat_nombre' => $_POST['cat_nombre'],
            'cat_descripcion' => $_POST['cat_descripcion']
        ];
        $categoriaModel->updateCategory($data);
        Alert::showSuccess('Categoria Actualizada','Actualizado Correctamente','/inventario/public/categorias');
    }
    public function delete() {
        if(!isset($_SESSION['username'])) {
            header('Location: /inventario/public');
        }
        $categoriaModel = new CategoriaModel;
        $categoriaModel->deleteCategory($_GET['cat_id']);
        Alert::showSuccess('Categoria Eliminada','Eliminado Correctamente','/inventario/public/categorias');
    }
}
?>