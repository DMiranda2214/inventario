<?php

namespace App\Controllers;

use App\Utils\Alert;
use App\Core\Controller;
use App\Core\View;
use App\Models\InventarioModel;


class InventarioController extends Controller {
    private $inventarioModel;

    public function __construct() {
        if(!isset($_SESSION['username'])) {
            header('Location: /inventario/public');
        }
        $this->inventarioModel = new InventarioModel();
    }

    public function index() {
        $GLOBALS['PAGE'] = 'inventario';
        View::load('index');
    }

    public function editarInventario() {
        $GLOBALS['PAGE'] = 'inventario';
        $GLOBALS['SECTION'] = 'editarInventario';
        View::load('index');
    }

    public function get() {
        $inventario = $this->inventarioModel->getTotalInventario();
        return $inventario;
    }

    public function getById($id) {
        $inventario = $this->inventarioModel->getInventarioById($id);
        return $inventario;
    }

    public function update() {
        $data = [
            'inv_id' => $_POST['inv_id'],
            'inv_precioVenta' => $_POST['inv_precioVenta']
        ];
        $this->inventarioModel->updateInventario($data);
        Alert::showSuccess('Actualización Exitosa','Inventario actualizado con exito', '/inventario/public/inventario');
    }
}

?>