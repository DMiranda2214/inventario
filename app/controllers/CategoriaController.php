<?php 

namespace App\Controllers;

use App\Core\Controller;
use App\Models\CategoriaModel;
use App\Core\View;

class CategoriaController extends Controller {
    public function index() {
        if(!isset($_SESSION['username'])) {
            header('Location: /inventario/public');
        }
        $GLOBALS['PAGE'] = 'productos';
        View::load('index');
    }

    public function agregarProducto() {
        if(!isset($_SESSION['username'])) {
            header('Location: /inventario/public');
        }
        $GLOBALS['PAGE'] = 'productos';
        $GLOBALS['SECTION'] = 'agregarProducto';
        View::load('index');
    }

    public function getNameCategories() {
        if(!isset($_SESSION['username'])) {
            header('Location: /inventario/public');
        }
        $categoriaModel = new CategoriaModel();
        $names = $categoriaModel->getCategoriesName();
        return $names;
    }


}

?>