<?php

use App\Controllers\VentasController;

$ventasController = new VentasController();
$pedido = $ventasController->getDetailSell($_GET['ped_id']);
?>
<br><br>
<div class="card">
    <div class="card-header">DETALLE VENTA</div>
    <div class="card-body">
        <div class="card mb-3">
            <div class="card-header"> INFORMACION CLIENTE </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        <div class="input-group">
                            <label class="col-lg-3 control-label" for="inputCliente">Cliente: </label>
                            <div class="input-group">
                                <input type="text" name="cli_nombre" value="<?= $pedido[0]['cli_nombre'] ?> <?= $pedido[0]['cli_apellido'] ?>" id="inputCliente" class="form-control" placeholder="Nombre del cliente" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <label for="inputFecha" class="">Fecha de venta:</label>
                        <input type="date" id="inputFecha" name="ped_fecha" value="<?= $pedido[0]['ped_fecha'] ?>" class="form-control" disabled>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header">DETALLE VENTA</div>
            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        <div class="input-group">
                            <label for="inputProducto" class="control-label">Producto: </label>
                            <div class="input-group">
                                <input type="text" name="pro_nombre" value="<?= $pedido[0]['pro_nombre'] ?>" id="inputProducto" class="form-control" placeholder="Nombre del producto" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <label for="inputCantidad" class="">Cantidad: </label>
                        <input type="number" name="cont_cantidad" value="<?= $pedido[0]['cont_cantidad'] ?>" id="inputCantidad" class="form-control" placeholder="Cantidad" disabled>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-6">
                        <label for="inputPrecio" class="">Precio por unidad: </label>
                        <input type="number" name="cont_precioUnitario" value="<?= $pedido[0]['cont_precioUnitario'] ?>" id="inputPrecio" class="form-control" placeholder="Precio" disabled>
                    </div>
                    <div class="col-6">
                        <label for="inputTotal" class="">Total: </label>
                        <input type="number" name="cont_pedidoSubTotal" value="<?= $pedido[0]['cont_pedidoSubTotal'] ?>" id="inputTotal" class="form-control" placeholder="Total" disabled>
                    </div>
                </div>

            </div>
        </div>
        <br>
        <form action="/inventario/public/ventas/generatePDFFactura" method="POST">
            <input type="text" name="ped_id" hidden value="<?= $pedido[0]['ped_id'] ?>">
            <div class="row">
                <div class="col-12">
                    <button type="submit" class="btn btn-primary">Generar Factura</button>
                    <!-- <button type="submit" class="btn btn-primary">Volver</button> -->
                </div>
            </div>
        </form>
    </div>
</div>