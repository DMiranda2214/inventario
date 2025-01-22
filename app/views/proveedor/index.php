<?php 
use App\Controllers\ProveedorController;
$proveedorController = new ProveedorController();
$proveedores = $proveedorController->get();
?>

<br>
<div>
    <a href="/inventario/public/proveedor/agregarProveedor" class="btn btn-primary">Agregar Proveedor</a>
</div>
<br>
<div class="card">
    <div class="card-header">PROVEEDORES</div>
    <div class="card-body">
        <div class="table-responsive col-md-12">
            <table class="table align-middle table-bordered">
                <thead>
                    <th class="col-md-4">Empresa</th>
                    <th class="col-md-4">Vendedor</th>
                    <th class="col-md-3">Direccion</th>
                    <th class="col-md-1">Telefono</th>
                    <th>Editar</th>
                </thead>
                <tbody class="table-group-divider">
                    <?php foreach ($proveedores as $proveedor): ?>
                        <tr>
                            <td><?=  $proveedor['prov_empresa'] ?></td>
                            <td><?=  $proveedor['prov_vendedor'] ?></td>
                            <td><?=  $proveedor['dPro_direccion'] ?></td>
                            <td><?=  $proveedor['tPro_telefono'] ?></td>
                            <td>
                                <a class="py-2 px-4 btn btn-info btn-xs" href="/inventario/public/Proveedor/editarProveedor?prov_id=<?= $proveedor['prov_id'] ?>">
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