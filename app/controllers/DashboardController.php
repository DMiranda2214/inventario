<?php
class DashboardController extends Controller {
    public function index() {
        if(!isset($_SESSION['username'])) {
            header('Location: /inventario/public');
        }
        $GLOBALS['PAGE'] = 'dashboard';
        View::load('index');
    }
}
?>