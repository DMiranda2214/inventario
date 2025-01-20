<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Core\View;

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