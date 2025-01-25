<?php

use App\Controllers\VentasController;

$ventasController = new VentasController();

$ventas = $ventasController->get();
?>

<br>
<div>
    <a href="/inventario/public/ventas/agregarVenta" class="btn btn-primary">Nueva Venta</a>
    <a href="/inventario/public/ventas/reporteVentas" class="btn btn-primary">Generar Reporte</a>
</div>
<br>
<div class="card">
    <div class="card-header">CLIENTES</div>
    <div class="card-body">
        <div class="table-responsive col-md-12">
            <table class="table align-middle table-bordered">
                <thead>
                    <th class="col-md-6">Cliente</th>
                    <th class="col-md-4">Fecha</th>
                    <th class="col-md-2">Total</th>
                </thead>
                <tbody class="table-group-divider">
                    <?php foreach ($ventas as $venta): ?>
                        <tr>
                            <td><?= $venta['cli_nombre'] ?> <?= $venta['cli_apellido'] ?></td>
                            <td><?= date('Y-m-d', strtotime($venta['ped_fecha'])) ?></td>
                            <td><?= $venta['ped_totalPedido'] ?></td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>