<?php
    use App\Controllers\InventarioController;
    $inventarioController = new InventarioController();
    $inventario = $inventarioController->get();
    $valorTotalInventario = function($cantidad, $valor) {
        $total = $cantidad  * $valor;
        return number_format($total);
    }
?>

<br>
<div class="card">
    <div class="card-header">INVENTARIO</div>
    <div class="card-body">
        <div class="table-responsive col-md-12">
            <table class="table align-middle table-bordered">
                <thead>
                    <th class="col-md-3">Producto</th>
                    <th class="col-md-3">Cantidad actual</th>
                    <th class="col-md-3">Precio Venta</th>
                    <th class="col-md-3">Valor Total Inventario</th>
                </thead>
                <tbody class="table-group-divider">
                    <?php foreach ($inventario as $compra): ?>
                        <tr>
                            <td><?= $compra['pro_nombre'] ?></td>
                            <td><?= $compra['inv_Stock'] ?></td>
                            <td>$<?= number_format($compra['inv_precioVenta']) ?></td>
                            <td>$<?= $valorTotalInventario($compra['inv_Stock'],$compra['inv_precioVenta']) ?></td>
                            
                        </tr>
                    <?php endforeach; ?>
            </table>
        </div>
    </div>