<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\View;
use App\Utils\Alert;
use App\Utils\DompdfUtil;
use App\Models\VentasModel;
use App\Models\ProductosModel;
use App\Enums\EstadoPedidoEnum;

class VentasController extends Controller
{
    private $ventasModel;
    private $productosModel;

    public function __construct()
    {
        if (!isset($_SESSION['username'])) {
            header('Location: /inventario/public');
        }
        $this->ventasModel = new VentasModel();
        $this->productosModel = new ProductosModel();
    }

    public function index()
    {
        $GLOBALS['PAGE'] = 'ventas';
        View::load('index');
    }

    public function agregarVenta()
    {
        $GLOBALS['PAGE'] = 'ventas';
        $GLOBALS['SECTION'] = 'agregarVenta';
        View::load('index');
    }

    public function reporteVentas()
    {
        $GLOBALS['PAGE'] = 'ventas';
        $GLOBALS['SECTION'] = 'reporteVentas';
        View::load('index');
    }

    public function detalleVenta()
    {
        $GLOBALS['PAGE'] = 'ventas';
        $GLOBALS['SECTION'] = 'detalleVenta';
        View::load('index');
    }

    public function get()
    {
        $ventas = $this->ventasModel->getTotalPedidos();
        return $ventas;
    }

    public function getById($id)
    {
        $venta = $this->ventasModel->getPedidoById($id);
        return $venta;
    }

    public function countVentas()
    {
        $total = $this->ventasModel->getCantidadVentas();
        return $total;
    }

    public function insert()
    {
        $priceProduct = $this->productosModel->getProductoById($_POST['sum_idProducto']);
        $data = [
            'ven_idCliente' => $_POST['ven_idCliente'],
            'ven_fecha' => $_POST['ven_fecha'],
            'ven_estado' => EstadoPedidoEnum::COMPLETADO->value,
            'ven_totalPedido' => $this->calcularTotalVenta($_POST['sum_cantidad'], $priceProduct['pro_precioVenta']),
            'sum_idProducto' => $_POST['sum_idProducto'],
            'sum_cantidad' => $_POST['sum_cantidad'],
            'sum_precioUnitario' => $priceProduct['pro_precioVenta'],
            'sum_subTotal' => $this->calcularTotalVenta($_POST['sum_cantidad'], $priceProduct['pro_precioVenta'])
        ];
        $this->ventasModel->insertVenta($data);
        Alert::showSuccess('Registro Exitoso', 'Venta registrada con exito', '/inventario/public/ventas');
    }

    public function getDetailSell($id)
    {
        $detalleVenta = $this->ventasModel->getDetailPedido($id);
        return $detalleVenta;
    }

    public function generatePDFSell()
    {
        date_default_timezone_set('America/Bogota');
        $htmlFile = realpath(__DIR__ . '/../templates/reportSell.html');
        $ventas = $this->getSellByPeriod($_POST['fechaInicio'], $_POST['fechaFin']);
        $totalVentas = $this->getTotalSellByPeriod($ventas);
        $countVentas = $this->getCountSellByPeriod($ventas);
        $tablaContenido = $this->generateDataTable($ventas);

        $data = [
            'filename' => 'ventas_' . $_POST['fechaInicio'] . '_' . $_POST['fechaFin'],
            'fechaGeneracion' => date('Y-m-d h:i:s A'),
            'fechaInicio' => $_POST['fechaInicio'],
            'fechaFin' => $_POST['fechaFin'],
            'cantidadVentas' => $countVentas,
            'totalVentas' => number_format($totalVentas),
            'tablaContenido' => $tablaContenido
        ];
        $htmlContent = file_get_contents($htmlFile);
        $dompdf = new DompdfUtil();
        $dompdf->generatePDFSell($htmlContent, $data);
    }

    public function generatePDFFactura() {
        $id = $_POST['ped_id'];
        date_default_timezone_set('America/Bogota');
        $htmlFile = realpath(__DIR__ . '/../templates/factura.html');
        $dataFactura = $this->getDetailSell($id);
        $tablaContenido = $this->generateFacturaDataTable($dataFactura);
        $data = [
            'filename' => 'factura_'. $dataFactura[0]['cli_nombre'].'_'.$dataFactura[0]['cli_apellido'],
            'nombreCliente' => $dataFactura[0]['cli_nombre'].' '.$dataFactura[0]['cli_apellido'],
            'fechaGeneracion' => date('Y-m-d h:i:s A'),
            'tablaContenido' => $tablaContenido,
            'totalVenta' => number_format($dataFactura[0]['cont_pedidoSubTotal'])
        ];
        $htmlContent = file_get_contents($htmlFile);
        $dompdf = new DompdfUtil();
        $dompdf->generatePDFFactura($htmlContent, $data);
    }

    private function getSellByPeriod($fechaInicio, $fechaFin)
    {
        $ventas = $this->ventasModel->getVentasByPeriodo($fechaInicio, $fechaFin);
        return $ventas;
    }

    private function getCountSellByPeriod($ventas)
    {
        return count($ventas);
    }

    private function getTotalSellByPeriod($ventas)
    {
        $total = 0;
        foreach ($ventas as $venta) {
            $total += $venta['ped_totalPedido'];
        }
        return $total;
    }

    private function generateDataTable($ventas)
    {
        $tablaContenido = '';
        foreach ($ventas as $fila) {
            $tablaContenido .= '<tr>';
            $tablaContenido .= '<td>' . $fila['ped_fecha'] .'</td>';
            $tablaContenido .= '<td>' . $fila['cli_nombre'] . ' '. $fila['cli_apellido'] .'</td>';
            $tablaContenido .= '<td>' . $fila['pro_nombre'] . '</td>';
            $tablaContenido .= '<td>' . $fila['cont_cantidad'] . '</td>';
            $tablaContenido .= '<td> $' . number_format($fila['ped_totalPedido']) . '</td>';
            $tablaContenido .= '</tr>';
        }
        return $tablaContenido;
    }

    private function generateFacturaDataTable($venta){
        $tablaContenido = '';
        foreach ($venta as $fila) {
            $tablaContenido .= '<tr>';
            $tablaContenido .= '<td>' . $fila['ped_fecha'] .'</td>';
            $tablaContenido .= '<td>' . $fila['pro_nombre'] . ' '. $fila['cli_apellido'] .'</td>';
            $tablaContenido .= '<td>' . $fila['cont_cantidad'] . '</td>';
            $tablaContenido .= '<td> $' . number_format($fila['cont_precioUnitario']) . '</td>';
            $tablaContenido .= '</tr>';
        }
        return $tablaContenido;
    }

    private function calcularTotalVenta($cantidad, $precioUnitario)
    {
        return $cantidad * $precioUnitario;
    }
}
