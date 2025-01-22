<?php

namespace App\Controllers;

use App\Utils\Alert;
use App\Core\Controller;
use App\Core\View;
use App\Models\ClientesModel;

class ClientesController extends Controller {
    private $clientesModel;
    
    public function __construct()
    {
        if(!isset($_SESSION['username'])) {
            header('Location: /inventario/public');
        }
        $this->clientesModel = new ClientesModel();
    }
    
    public function index() {
        $GLOBALS['PAGE'] = 'clientes';
        View::load('index');
    }

    public function agregarCliente() {
        $GLOBALS['PAGE'] = 'clientes';
        $GLOBALS['SECTION'] = 'agregarCliente';
        View::load('index');
    }

    public function editarCliente() {
        $GLOBALS['PAGE'] = 'clientes';
        $GLOBALS['SECTION'] = 'editarCliente';
        View::load('index');
    }

    public function countClientes() {
        $total = $this->clientesModel->getCantidadClientes();
        return $total;
    }

    public function get() {
        $clientes = $this->clientesModel->getAllClients();
        return $clientes;
    }

    public function getById($id) {
        $cliente = $this->clientesModel->getClienteById($id);
        return $cliente;
    }

    public function insert() {
        $data = [
            'cli_nombre' => $_POST['cli_nombre'],
            'cli_apellido' => $_POST['cli_apellido'],
            'cli_telefono' => $_POST['cli_telefono'],
            'cli_direccion' => $_POST['cli_direccion'],
            'cli_email' => $_POST['cli_email'],
        ];
        $cliente = $this->clientesModel->insertClient($data);
        Alert::showSuccess('Nuevo Cliente','Ingresado Correctamente','/inventario/public/clientes');
    }

    public function edit() {
        $data = [
            'cli_id' => $_POST['cli_id'],
            'cli_email' => $_POST['cli_email'],
            'cli_direccion' => $_POST['cli_direccion'],
            'cli_telefono' => $_POST['cli_telefono'],
        ];
        $cliente = $this->clientesModel->updateClient($data);
        Alert::showSuccess('Cliente Actualizado','Actualizado Correctamente','/inventario/public/clientes');
    }
}
?>