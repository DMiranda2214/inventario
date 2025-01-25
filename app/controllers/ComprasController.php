<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\View;
use App\Utils\Alert;
use App\Utils\DompdfUtil;
use App\Models\ComprasModel;

class ComprasController extends Controller
{
    private $comprasModel;

    public function __construct()
    {
        if (!isset($_SESSION['username'])) {
            header('Location: /inventario/public');
        }
        $this->comprasModel = new ComprasModel();
    }

    public function index()
    {
        $GLOBALS['PAGE'] = 'compras';
        View::load('index');
    }

    public function agregarCompra()
    {
        $GLOBALS['PAGE'] = 'compras';
        $GLOBALS['SECTION'] = 'agregarCompra';
        View::load('index');
    }

    public function reporteCompras()
    {
        $GLOBALS['PAGE'] = 'compras';
        $GLOBALS['SECTION'] = 'reporteCompras';
        View::load('index');
    }

    public function detalleCompra() {
        $GLOBALS['PAGE'] = 'compras';
        $GLOBALS['SECTION'] = 'detalleCompra';
        View::load('index');
    }

    public function get()
    {
        $compras = $this->comprasModel->getTotalCompras();
        return $compras;
    }

    public function getDetailBuy($id) {
        $compras = $this->comprasModel->getDetailCompra($id);
        return $compras;
    }

    public function insert()
    {
        $data = [
            'com_idProveedor' => $_POST['com_idProveedor'],
            'com_fecha' => $_POST['com_fecha'],
            'com_totalCompra' => $this->calcularTotalCompra($_POST['sum_cantidad'], $_POST['sum_precioUnitario']),
            'sum_idProducto' => $_POST['sum_idProducto'],
            'sum_cantidad' => $_POST['sum_cantidad'],
            'sum_precioUnitario' => $_POST['sum_precioUnitario'],
            'sum_subTotal' => $this->calcularTotalCompra($_POST['sum_cantidad'], $_POST['sum_precioUnitario'])
        ];
        $this->comprasModel->insertCompra($data);
        Alert::showSuccess('Registro Exitoso', 'Compra registrada con exito', '/inventario/public/compras');
    }

    public function generatePDFBuy()
    {
        try {
            date_default_timezone_set('America/Bogota');
            $htmlFile = realpath(__DIR__ . '/../templates/reportBuy.html');
            $compras = $this->getBuyByPeriod($_POST['fechaInicio'], $_POST['fechaFin']);
            $totalCompras = $this->getTotalBuyByPeriod($compras);
            $cantidadCompras = $this->getCountBuyByPeriod($compras);
            $tablaContenido = $this->generateDataTable($compras);

            $data = [
                'filename' => 'compras_' . $_POST['fechaInicio'] . '_' . $_POST['fechaFin'],
                'fechaGeneracion' => date('Y-m-d h:i:s A'),
                'fechaInicio' => $_POST['fechaInicio'],
                'fechaFin' => $_POST['fechaFin'],
                'cantidadCompras' => $cantidadCompras,
                'totalCompras' => number_format($totalCompras),
                'tablaContenido' => $tablaContenido
            ];
            $htmlContent = file_get_contents($htmlFile);
            $dompdf = new DompdfUtil();
            $dompdf->generatePDFBuy($htmlContent, $data);
        } catch (\Exception $e) {
            Alert::showError('Error', $e->getMessage(), '/inventario/public/compras');
        }
    }

    private function getBuyByPeriod($fechaInicio, $fechaFin)
    {
        $compras = $this->comprasModel->getComprasByPeriodo($fechaInicio, $fechaFin);
        return $compras;
    }

    private function getCountBuyByPeriod($compras)
    {
        return count($compras);
    }

    private function getTotalBuyByPeriod($compras)
    {
        $total = 0;
        foreach ($compras as $compra) {
            $total += $compra['com_totalCompra'];
        }
        return $total;
    }

    private function generateDataTable($ventas)
    {
        $tablaContenido = '';
        foreach ($ventas as $fila) {
            $tablaContenido .= '<tr>';
            $tablaContenido .= '<td>' . $fila['com_fecha'] . '</td>';
            $tablaContenido .= '<td>' . $fila['prov_empresa'] .'</td>';
            $tablaContenido .= '<td>' . $fila['pro_nombre'] . '</td>';
            $tablaContenido .= '<td>' . $fila['sum_cantidad'] . '</td>';
            $tablaContenido .= '<td> $' . number_format($fila['com_totalCompra']) . '</td>';
            $tablaContenido .= '</tr>';
        }
        return $tablaContenido;
    }

    private function calcularTotalCompra($cantidad, $precioUnitario)
    {
        return $cantidad * $precioUnitario;
    }
}
