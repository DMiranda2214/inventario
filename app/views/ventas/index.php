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
                    <th class="col-md-5">Cliente</th>
                    <th class="col-md-5">Fecha</th>
                    <th class="col-md-2">Total</th>
                    <th class="col-md-2">Detalles</th>
                </thead>
                <tbody class="table-group-divider">
                    <?php foreach ($ventas as $venta): ?>
                        <tr>
                            <td><?= $venta['cli_nombre'] ?> <?= $venta['cli_apellido'] ?></td>
                            <td><?= date('Y-m-d', strtotime($venta['ped_fecha'])) ?></td>
                            <td><?= $venta['ped_totalPedido'] ?></td>
                            <td>
                                <a class="py-2 px-4 btn btn-info btn-xs" href="/inventario/public/ventas/detalleVenta?ped_id=<?= $venta['ped_id'] ?>">
                                    <img src="/inventario/public/icons/info.svg" alt="Logo">
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>