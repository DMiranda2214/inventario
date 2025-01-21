<?php 

namespace App\Controllers;

use App\Utils\Alert;
use App\Core\Controller;
use App\Core\View;
use App\Models\ProductosModel;

class ProductosController extends Controller {
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

    public function countProducts() {
        $productosModel = new ProductosModel();
        $total = $productosModel->getCantidadProductos();
        return $total;
    }

    public function getTotalProducts() {
        $productosModel = new ProductosModel();
        $productos = $productosModel->getTotalProductos();
        return $productos;
    }

    public function getTotalProductsByPage($page, $limit) {
        $productosModel = new ProductosModel();
        $productos = $productosModel->getTotalProductosByPage($page, $limit);
        return $productos;
    }

    public function insert(){
        $productosModel = new ProductosModel();
        $data = [
            'nombre' => $_POST['nombre'],
            'categoria' => $_POST['categoria'],
            'description' => $_POST['description'],
            'priceShop' => $_POST['priceShop'],
            'inventoryInit' => $_POST['inventoryInit'],
            'priceSell' => $_POST['priceSell'],
            'inventoryMin' => $_POST['inventoryMin'],
        ];
        $producto = $productosModel->insertProduct($data);
        Alert::showSuccess('Nuevo Producto', 'Ingresado Correctamente   ', '/inventario/public/productos');

    }


}

?>