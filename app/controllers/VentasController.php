<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Core\View;
use App\Utils\Alert;
use App\Models\VentasModel;
use App\Models\ProductosModel;
use App\Enums\EstadoPedidoEnum;

class VentasController extends Controller {
    private $ventasModel;
    private $productosModel;

    public function __construct() {
        if(!isset($_SESSION['username'])) {
            header('Location: /inventario/public');
        }
        $this->ventasModel = new VentasModel();
        $this->productosModel = new ProductosModel();
    }

    public function index() {
        $GLOBALS['PAGE'] = 'ventas';
        View::load('index');
    }

    public function agregarVenta() {
        $GLOBALS['PAGE'] = 'ventas';
        $GLOBALS['SECTION'] = 'agregarVenta';
        View::load('index');
    }

    public function get() {
        $ventas = $this->ventasModel->getTotalPedidos();
        return $ventas;
    }

    public function getById($id) {
        $venta = $this->ventasModel->getPedidoById($id);
        return $venta;
    }

    public function countVentas() {
        $total = $this->ventasModel->getCantidadVentas();
        return $total;
    }

    public function insert() {
        $priceProduct = $this->productosModel->getProductoById($_POST['sum_idProducto']);
        $data = [
            'ven_idCliente' => $_POST['ven_idCliente'],
            'ven_fecha' => $_POST['ven_fecha'],
            'ven_estado' => EstadoPedidoEnum::COMPLETADO->value,
            'ven_totalPedido' => $this->calcularTotalVenta($_POST['sum_cantidad'],$priceProduct['pro_precioVenta']),
            'sum_idProducto' => $_POST['sum_idProducto'],
            'sum_cantidad' => $_POST['sum_cantidad'],
            'sum_precioUnitario' => $priceProduct['pro_precioVenta'],
            'sum_subTotal' => $this->calcularTotalVenta($_POST['sum_cantidad'],$priceProduct['pro_precioVenta'])
        ];
        $this->ventasModel->insertVenta($data);
        Alert::showSuccess('Registro Exitoso','Venta registrada con exito', '/inventario/public/ventas');
    }

    private function calcularTotalVenta($cantidad,$precioUnitario) {
        return $cantidad * $precioUnitario;
    }


}
?>