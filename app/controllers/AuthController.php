<?php

use App\Utils\Alert;

class AuthController extends Controller {
    private $UserModel;

    public function __construct() {
        $this->UserModel = $this->model('AuthModel');
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

            $loggedInUser = $this->UserModel->findUserByEmail($data['username']);
            if($loggedInUser && $this->validatePassword($data['password'], $loggedInUser['password'])) {
                Alert::showSuccess('Bienvenido', 'Inicio de sesión exitoso', '/inventario/public/dashboard/index');
            }
            else {
                Alert::showError('Error', 'Usuario o contraseña incorrectos', '/inventario/public');
            }
        }
    }

    private function validatePassword($password, $hash) {
        if($password == $hash) {
            return true;
        } else {
            return false;
        }
        //return password_verify($password, $hash);
    }
}
?>