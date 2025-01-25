<?php
use App\Controllers\ClientesController;
$clientesController = new ClientesController();
$clientes = $clientesController->get();
?>
<br>
<div>
    <a href="/inventario/public/Clientes/agregarCliente" class="btn btn-primary">Agregar Cliente</a>
</div>
<br>
<div class="card">
    <div class="card-header">CLIENTES</div>
    <div class="card-body">
        <div class="table-responsive col-md-12">
            <table class="table align-middle table-bordered">
                <thead>
                    <th class="col-md-1">Nombre</th>
                    <th class="col-md-1">Apellido</th>
                    <th class="col-md-4">Correo</th>
                    <th class="col-md-4">Direccion</th>
                    <th class="col-md-2">Telefono</th>
                    <th>Editar</th>
                </thead>
                <tbody class="table-group-divider">
                    <?php foreach ($clientes as $cliente): ?>
                        <tr>
                            <td><?=  $cliente['cli_nombre'] ?></td>
                            <td><?=  $cliente['cli_apellido'] ?></td>
                            <td><?=  $cliente['cli_email'] ?></td>
                            <td><?=  $cliente['dCli_direccion'] ?></td>
                            <td><?=  $cliente['tCli_telefono'] ?></td>
                            <td>
                                <a class="py-2 px-4 btn btn-info btn-xs" href="/inventario/public/Clientes/editarCliente?cli_id=<?= $cliente['cli_id'] ?>">
                                    <svg class="btn-icon" width="24" height="24">
                                        <use xlink:href="/inventario/public/icons/free.svg#cil-pencil"></use>
                                    </svg>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>