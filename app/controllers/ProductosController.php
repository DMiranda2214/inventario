<?php 

namespace App\Controllers;

use App\Utils\Alert;
use App\Core\Controller;
use App\Core\View;
use App\Models\ProductosModel;

class ProductosController extends Controller {
    private $productosModel;

    public function __construct() {
        if(!isset($_SESSION['username'])) {
            header('Location: /inventario/public');
        }
        $this->productosModel = new ProductosModel();
    }

    public function index() {
        $GLOBALS['PAGE'] = 'productos';
        View::load('index');
    }

    public function agregarProducto() {
        $GLOBALS['PAGE'] = 'productos';
        $GLOBALS['SECTION'] = 'agregarProducto';
        View::load('index');
    }

    public function editarProducto() {
        $GLOBALS['PAGE'] = 'productos';
        $GLOBALS['SECTION'] = 'editarProducto';
        View::load('index');
    }

    public function eliminarProducto() {
        Alert::showDelete(
            '/inventario/public/Productos/delete?pro_id='.$_GET['pro_id'].'',
            '/inventario/public/productos'
        );
    }

    public function countProducts() {
        $total = $this->productosModel->getCantidadProductos();
        return $total;
    }

    public function getTotalProducts() {
        $productos = $this->productosModel->getTotalProductos();
        return $productos;
    }

    public function getTotalProductsByPage($page, $limit) {
        $productos = $this->productosModel->getTotalProductosByPage($page, $limit);
        return $productos;
    }

    public function getByid($id) {
        $producto = $this->productosModel->getProductoById($id);
        return $producto;
    }

   public function getProductsToSell() {
        $productos = $this->productosModel->getProductsToSell();
        return $productos;
    }

    public function insert(){
        $data = [
            'pro_nombre' => $_POST['pro_nombre'],
            'pro_idCategoria' => $_POST['pro_idCategoria'],
            'pro_descripcion' => $_POST['pro_descripcion'],
            'pro_precioVenta' => $_POST['pro_precioVenta'],
            'pro_cantMin' => $_POST['pro_cantMin']
        ];
        $producto = $this->productosModel->insertProduct($data);
        Alert::showSuccess('Nuevo Producto', 'Ingresado Correctamente   ', '/inventario/public/productos');
    }

    public function edit(){
        $data = [
            'pro_id' => $_POST['pro_id'],
            'pro_nombre' => $_POST['pro_nombre'],
            'pro_idCategoria' => $_POST['pro_idCategoria'],
            'pro_descripcion' => $_POST['pro_descripcion'],
            'pro_precioVenta' => $_POST['pro_precioVenta'],
            'pro_cantMin' => $_POST['pro_cantMin']
        ];
        $this->productosModel->updateProduct($data);
        Alert::showSuccess('Producto Actualizado', 'Actualizado Correctamente', '/inventario/public/productos');
    }

    public function delete() {
        $this->productosModel->deleteProduct($_GET['pro_id']);
        Alert::showSuccess('Producto Eliminado', 'Eliminado Correctamente', '/inventario/public/productos');
    }

    public function validateStatusInventario() {
        $productos = $this->productosModel->validateStatusInventory();
        return $productos;
    }
}

?>