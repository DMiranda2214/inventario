<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Core\View;
use App\Utils\Alert;
use App\Models\UsuarioModel;
use App\Enums\EstadoUsuarioEnum;

class UsuariosController extends Controller {
    private $usuarioModel;

    public function __construct() {
        if(!isset($_SESSION['username'])) {
            header('Location: /inventario/public');
        }
        $this->usuarioModel = new UsuarioModel();
    }

    public function index() {
        $GLOBALS['PAGE'] = 'usuarios';
        View::load('index');
    }

    public function agregarUsuario() {
        $GLOBALS['PAGE'] = 'usuarios';
        $GLOBALS['SECTION'] = 'agregarUsuario';
        View::load('index');
    }

    public function editarUsuario() {
        $GLOBALS['PAGE'] = 'usuarios';
        $GLOBALS['SECTION'] = 'editarUsuario';
        View::load('index');
    }

    public function eliminarUsuario() {
        Alert::showDelete('/inventario/public/Usuarios/delete?usu_id='.$_GET['usu_id'].'','/inventario/public/usuarios');
    }

    public function get() {
        $AllUsers = $this->usuarioModel->getAllUsers();
        $usuarios = $this->deleteAdminUser($AllUsers);
        return $usuarios;
    }

    public function getById($id) {
        $usuario = $this->usuarioModel->getUserById($id);
        return $usuario;
    }

    public function insert() {
        $data = [
            'usu_nombre' => $_POST['usu_nombre'],
            'usu_cuenta' => $_POST['usu_cuenta'],
            'usu_email' => $_POST['usu_email'],
            'usu_password' => $this->hashPassword($_POST['usu_password']),
            'usu_estado' => EstadoUsuarioEnum::ACTIVO->value,
        ];
        $usuario = $this->usuarioModel->insertUser($data);
        Alert::showSuccess('Nuevo Usuario','Ingresado Correctamente','/inventario/public/usuarios');
    }

    public function edit() {
        $usu_estado = isset($_POST['usu_estado']) ? EstadoUsuarioEnum::ACTIVO->value : EstadoUsuarioEnum::BLOQUEADO->value;
        $data = [
            'usu_id' => $_POST['usu_id'],
            'usu_cuenta' => $_POST['usu_cuenta'],
            'usu_password' => $this->hashPassword($_POST['usu_password']),
            'usu_estado' => $usu_estado,
        ];
        $usuario = $this->usuarioModel->updateUser($data);
        Alert::showSuccess('Usuario Editado','Editado Correctamente','/inventario/public/usuarios');
    }

    public function delete() {
        $this->usuarioModel->deleteUser($_GET['usu_id']);
        Alert::showSuccess('Usuario Eliminado','Eliminado Correctamente','/inventario/public/usuarios');
    }

    private function hashPassword($password) {
        return password_hash($password, PASSWORD_DEFAULT);
    }

    private function deleteAdminUser($usuarios) {
        return array_filter($usuarios, function($usuario) {
            return $usuario['usu_cuenta'] !== 'admin';
        });
    }
}
?>