<?php
    use App\Controllers\ComprasController;
    $comprasController = new ComprasController();
    $compras = $comprasController->get();
?>
<br>
<div>
    <a href="/inventario/public/compras/agregarCompra" class="btn btn-primary">Nueva Compra</a>
    <a href="/inventario/public/compras/reporteCompras" class="btn btn-primary">Reporte Compras</a>
</div>
<br>
<div class="card">
    <div class="card-header">COMPRAS</div>
    <div class="card-body">
        <div class="table-responsive col-md-12">
            <table class="table align-middle table-bordered">
                <thead>
                    <th class="col-md-3">Fecha</th>
                    <th class="col-md-3">Producto</th>
                    <th class="col-md-3">Proveedor</th>
                    <th class="col-md-2">Total</th>
                    <th class="col-md-1">Detalles</th>
                </thead>
                <tbody class="table-group-divider">
                    <?php foreach ($compras as $compra): ?>
                        <tr>
                            <td><?= date('Y-m-d', strtotime($compra['com_fecha'])) ?></td>
                            <td><?= $compra['producto'] ?></td>
                            <td><?= $compra['proveedor'] ?></td>
                            <td><?= $compra['com_totalCompra'] ?></td>
                            <td>
                                <a class="py-2 px-4 btn btn-info btn-xs" href="/inventario/public/compras/detalleCompra?com_id=<?= $compra['com_id'] ?>">
                                    <img src="/inventario/public/icons/info.svg" alt="Logo">
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>