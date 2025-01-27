<?php

use App\Controllers\UsuariosController;

$usuariosController = new UsuariosController();
$usuarios = $usuariosController->get();
$estado = function ($estado) {
    return $estado == 1000 ? 'checked' : '';
};
?>
<br>
<div>
    <a href="/inventario/public/usuarios/agregarUsuario" class="btn btn-primary">Agregar usuario</a>
</div>
<br>
<div class="card">
    <div class="card-header">USUARIOS</div>
    <div class="card-body">
        <div class="table-responsive col-md-12">
            <table class="table align-middle table-bordered">
                <thead>
                    <th class="col-md-4">Nombre</th>
                    <th class="col-md-4">Cuenta</th>
                    <th class="col-md-4">Email</th>
                    <th class="col-md-4">Estado</th>
                    <th>Editar</th>
                    <th>Eliminar</th>
                </thead>
                <tbody class="table-group-divider">
                    <?php foreach ($usuarios as $usuario): ?>
                        <tr>
                            <td><?= $usuario['usu_nombre'] ?></td>
                            <td><?= $usuario['usu_cuenta'] ?></td>
                            <td><?= $usuario['usu_email'] ?></td>
                            <td><input class="form-check-input" type="checkbox" value="" id="flexCheckChecked" disabled <?= $estado($usuario['usu_idEstado']) ?>></td>
                            <td>
                                <a class="py-2 px-4 btn btn-info btn-xs" href="/inventario/public/usuarios/editarusuario?usu_id=<?= $usuario['usu_id'] ?>">
                                    <svg class="btn-icon" width="24" height="24">
                                        <use xlink:href="/inventario/public/icons/free.svg#cil-pencil"></use>
                                    </svg>
                                </a>
                            </td>
                            <?php if ($_SESSION['username'] === $usuario['usu_nombre']): ?>
                                <td></td>
                            <?php else: ?>
                                <td class="d-flex">
                                    <a class="py-2 px-4 btn btn-danger btn-xs" href="/inventario/public/Usuarios/eliminarUsuario?usu_id=<?= $usuario['usu_id'] ?>">
                                        <svg class="btn-icon" width="24" height="24">
                                            <use xlink:href="/inventario/public/icons/free.svg#cil-trash"></use>
                                        </svg>
                                    </a>
                                </td>
                            <?php endif; ?>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>