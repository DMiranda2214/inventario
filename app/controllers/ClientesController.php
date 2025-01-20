<?php

namespace App\Controllers;

use App\Core\Controller;
use App\Core\View;
use App\Models\ClientesModel;

class ClientesController extends Controller {
    public function index() {
        if(!isset($_SESSION['username'])) {
            header('Location: /inventario/public');
        }
        $GLOBALS['PAGE'] = 'clientes';
        View::load('index');
    }

    public function countClientes() {
        $clientesModel = new ClientesModel();
        $total = $clientesModel->getCantidadClientes();
        return $total;
    }
}
?>