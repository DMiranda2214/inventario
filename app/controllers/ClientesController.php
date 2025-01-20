<?php
class ClientesController extends Controller {
    public function index() {
        if(!isset($_SESSION['username'])) {
            header('Location: /inventario/public');
        }
        $GLOBALS['PAGE'] = 'clientes';
        View::load('index');
    }
}
?>