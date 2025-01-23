<?php

use App\Controllers\UsuariosController;

$usuariosController = new UsuariosController();
$usuario = $usuariosController->getById($_GET['usu_id']);
$estado = $usuario['usu_idEstado'] == 1000 ? 'checked' : '';
?>

<br>
<div class="card">
    <div class="card-header">
        <strong>Editar Usuario</strong>
    </div>
    <div class="card-body">
        <form action="/inventario/public/Usuarios/edit" class="form-horizontal" method="post">
            <div class="row mb-3">
                <div class="col-6">
                    <label class="col-lg-3 control-label" for="inputUserNombre">Nombre</label>
                    <div class="input-group">
                        <input type="text" name="usu_nombre" value="<?= $usuario['usu_nombre'] ?>" disabled class="form-control" id="inputUserNombre" placeholder="Nombre del Usuario">
                    </div>
                </div>
                <div class="col-6">
                    <label class="col-lg-3 control-label" for="inputUserCuenta">Cuenta</label>
                    <div class="input-group">
                        <input type="text" name="usu_cuenta" value="<?= $usuario['usu_cuenta'] ?>" class="form-control" id="inputUserCuenta" placeholder="Cuenta de autenticacion">
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-6">
                    <label class="col-lg-3 control-label" for="inputUserEmail">Correo</label>
                    <div class="input-group">
                        <input type="email" name="usu_email" value="<?= $usuario['usu_email'] ?>" disabled class="form-control" id="inputUserEmail" placeholder="Correo del usuario">
                    </div>
                </div>
                <div class="col-6">
                    <label class="col-lg-3 control-label" for="inputUserPassword">Contraseña</label>
                    <div class="input-group">
                        <input type="password" name="usu_password" value="<?= $usuario['usu_password'] ?>" class="form-control" id="inputUserPassword" placeholder="Contraseña de autenticacion">
                    </div>
                </div>
            </div>
            <div class="form-check form-switch">
                <input class="form-check-input" name="usu_estado" type="checkbox" id="flexSwitchCheckDefault" <?=$estado?>>
                <label class="form-check-label" for="flexSwitchCheckDefault">Estado de la cuenta</label>
            </div>
            <br>
            <div class="row mb-3">
                <div class="form-group">
                    <div class="col-lg-offset-2 col-lg-10">
                    <input type="text" hidden name="usu_id"value="<?= $usuario['usu_id'] ?>">
                        <button type="submit" class="btn btn-primary">Editar Usuario</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>