<?php 

namespace App\Controllers;

use App\Core\Controller;
use App\Models\ProductosModel;
use App\Core\View;

class ProductosController extends Controller {
    public function index() {
        if(!isset($_SESSION['username'])) {
            header('Location: /inventario/public');
        }
        $GLOBALS['PAGE'] = 'productos';
        View::load('index');
    }

    public function countProducts() {
        $productosModel = new ProductosModel();
        $total = $productosModel->getCantidadProductos();
        return $total;
    }


}

?>