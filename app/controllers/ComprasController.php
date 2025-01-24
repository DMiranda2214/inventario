<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Core\View;
use App\Utils\Alert;
use App\Models\ComprasModel;

class ComprasController extends Controller {
    private $comprasModel;

    public function __construct() {
        if(!isset($_SESSION['username'])) {
            header('Location: /inventario/public');
        }
        $this->comprasModel = new ComprasModel();
    }

    public function index() {
        $GLOBALS['PAGE'] = 'compras';
        View::load('index');
    }

    public function agregarCompra() {
        $GLOBALS['PAGE'] = 'compras';
        $GLOBALS['SECTION'] = 'agregarCompra';
        View::load('index');
    }


    public function insert() {
        $data = [
            'com_idProveedor' => $_POST['com_idProveedor'],
            'com_fecha' => $_POST['com_fecha'],
            'com_totalCompra' => $this->calcularTotalCompra($_POST['sum_cantidad'],$_POST['sum_precioUnitario']),
            'sum_idProducto' => $_POST['sum_idProducto'],
            'sum_cantidad' => $_POST['sum_cantidad'],
            'sum_precioUnitario' => $_POST['sum_precioUnitario'],
            'sum_subTotal' => $this->calcularTotalCompra($_POST['sum_cantidad'],$_POST['sum_precioUnitario'])
        ];
        $this->comprasModel->insertCompra($data);
        Alert::showSuccess('Registro Exitoso','Compra registrada con exito', '/inventario/public/compras');
    }


    private function calcularTotalCompra($cantidad,$precioUnitario) {
        return $cantidad * $precioUnitario;
    }
}
?>