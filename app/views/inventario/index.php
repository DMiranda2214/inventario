<?php
    use App\Controllers\InventarioController;
    $inventarioController = new InventarioController();
    $inventario = $inventarioController->get();
?>

<br>
<div class="card">
    <div class="card-header">INVENTARIO</div>
    <div class="card-body">
        <div class="table-responsive col-md-12">
            <table class="table align-middle table-bordered">
                <thead>
                    <th class="col-md-4">Producto</th>
                    <th class="col-md-4">Cantidad actual</th>
                    <th class="col-md-3">Precio Venta</th>
                    <th class="col-md-1">Editar</th>
                </thead>
                <tbody class="table-group-divider">
                    <?php foreach ($inventario as $compra): ?>
                        <tr>
                            <td><?= $compra['pro_nombre'] ?></td>
                            <td><?= $compra['inv_Stock'] ?></td>
                            <td><?= $compra['inv_precioVenta'] ?></td>
                            <td>
                                <a class="py-2 px-4 btn btn-info btn-xs" href="/inventario/public/Inventario/editarInventario?inv_id=<?= $compra['inv_id'] ?>">
                                    <svg class="btn-icon" width="24" height="24">
                                        <use xlink:href="/inventario/public/icons/free.svg#cil-pencil"></use>
                                    </svg>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
            </table>
        </div>
    </div>