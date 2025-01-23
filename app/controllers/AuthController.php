<?php

namespace App\Controllers;

use App\Utils\Alert;
use App\Core\Controller;
use App\Models\AuthModel;

class AuthController extends Controller {
    private $AuthModel;

    public function __construct() {
        $this->AuthModel = new AuthModel();
    }

    public function index() {
        $this->view('auth/login');
    }

    public function login() {
        if($_SERVER['REQUEST_METHOD'] == 'POST') {
            $data = [
                'username' => $_POST['username'],
                'password' => $_POST['password']
            ];

            $loggedInUser = $this->AuthModel->findUserByEmail($data['username']);
            if($loggedInUser && $this->validatePassword($data['password'], $loggedInUser['usu_password'])) {
                $_SESSION['username'] = $loggedInUser['usu_nombre'];
                Alert::showSuccess('Bienvenido', 'Inicio de sesión exitoso', '/inventario/public/dashboard');
            }
            else {
                Alert::showError('Error', 'Usuario o contraseña incorrectos', '/inventario/public');
            }
        }
    }

    private function validatePassword($password, $hash) {
        return password_verify($password, $hash);
    }
}
?>