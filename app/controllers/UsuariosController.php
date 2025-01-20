<?php
class UsuariosController extends Controller {
    public function index() {
        if(!isset($_SESSION['username'])) {
            header('Location: /inventario/public');
        }
        $GLOBALS['PAGE'] = 'usuarios';
        View::load('index');
    }
}
?>