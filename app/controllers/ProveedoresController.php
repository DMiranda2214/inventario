<?php
class ProveedoresController extends Controller {
    public function index() {
        if(!isset($_SESSION['username'])) {
            header('Location: /inventario/public');
        }
        $GLOBALS['PAGE'] = 'proveedores';
        View::load('index');
    }
}
?>