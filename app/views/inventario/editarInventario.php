<?php

use App\Controllers\InventarioController;

$inventarioController = new InventarioController();
$inventario = $inventarioController->getById($_GET['inv_id']);
?>
<br><br>
<div class="card">
    <div class="card-header">
        EDITAR INVENTARIO
    </div>
    <div class="card-body">
        <form action="/inventario/public/Inventario/update" method="POST">
            <input type="hidden" name="inv_id" value="<?= $inventario['inv_id'] ?>">
            <div class="row mb-3">
                <div class="col-12">
                    <label class="col-lg-3 control-label" for="inlineFormInputGroupProduct">Producto</label>
                    <div class="input-group">
                        <input required type="text" name="inv_idProducto" value="<?= $inventario['pro_nombre'] ?>" class="form-control" id="inlineFormInputGroupProduct" placeholder="Producto" disabled>
                    </div>
                </div>

            </div>
            <div class="row mb-3">
                <div class="col-6">
                    <label class="col-lg-3 control-label" for="inlineFormInputGroupStock">Cantidad</label>
                    <div class="input-group">
                        <input required type="number" name="inv_Stock" value="<?= $inventario['inv_Stock'] ?>" class="form-control" id="inlineFormInputGroupStock" placeholder="Cantidad" disabled>
                    </div>
                </div>
                <div class="col-6">
                    <label class="control-label" for="inlineFormInputGroupSellPrice">Precio de venta</label>
                    <div class="input-group">
                        <div class="input-group-text">$</div>
                        <input required type="number" name="inv_precioVenta" value="<?= $inventario['inv_precioVenta'] ?>" class="form-control" id="inlineFormInputGroupSellPrice" placeholder="Precio de venta">
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-12">
                    <button type="submit" class="btn btn-primary">Guardar</button>
                </div>
            </div>
        </form>
    </div>
</div>