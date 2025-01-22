<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Core\View;
use App\Utils\Alert;
use App\Models\ProveedorModel;

class ProveedorController extends Controller {
    private $proveedoresModel;
    
    public function __construct() {
        if(!isset($_SESSION['username'])) {
            header('Location: /inventario/public');
        }
        $this->proveedoresModel = new ProveedorModel();
    }

    public function index() {
        $GLOBALS['PAGE'] = 'proveedor';
        View::load('index');
    }

    public function agregarProveedor() {
        $GLOBALS['PAGE'] = 'proveedor';
        $GLOBALS['SECTION'] = 'agregarProveedor';
        View::load('index');
    }

    public function editarProveedor() {
        $GLOBALS['PAGE'] = 'proveedor';
        $GLOBALS['SECTION'] = 'editarProveedor';
        View::load('index');
    }

    public function countProveedores() {
        $total = $this->proveedoresModel->getCantidadProveedores();
        return $total;
    }

    public function get() {
        $proveedores = $this->proveedoresModel->getAllProviders();
        return $proveedores;
    }

    public function getById($id) {
        $proveedor = $this->proveedoresModel->getProviderById($id);
        return $proveedor;
    }

    public function insert() {
        $data = [
            'prov_empresa' => $_POST['prov_empresa'],
            'prov_vendedor' => $_POST['prov_vendedor'],
            'prov_email' => $_POST['prov_email'],
            'prov_direccion' => $_POST['prov_direccion'],
            'prov_telefono' => $_POST['prov_telefono'],
        ];
        $proveedor = $this->proveedoresModel->insertProvider($data);
        Alert::showSuccess('Nuevo Proveedor','Ingresado Correctamente','/inventario/public/proveedor');
    }

    public function edit() {
        $data = [
            'prov_id' => $_POST['prov_id'],
            'prov_vendedor' => $_POST['prov_vendedor'],
            'prov_email' => $_POST['prov_email'],
            'prov_direccion' => $_POST['prov_direccion'],
            'prov_telefono' => $_POST['prov_telefono'],
        ];
        $proveedor = $this->proveedoresModel->updateProvider($data);
        Alert::showSuccess('Proveedor Actualizado','Actualizado Correctamente','/inventario/public/proveedor');
    }
}
?>