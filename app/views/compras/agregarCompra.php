<?php
use App\Controllers\ProductosController;
use App\Controllers\ProveedorController;

$proveedorController = new ProveedorController();
$productoController = new ProductosController();

$listProductos = $productoController->getTotalProducts();
$listProveedor = $proveedorController->get();
?>

<br>
<div class="card">
    <div class="card-header">
        <strong>INFORMACION COMPRA</strong>
    </div>
    <div class="card-body">
        <form action="/inventario/public/Compras/insert" method="POST">
            <div class="d-flex mb-3">
                <div class="card col-6 me-2">
                    <div class="card-header"><strong>INFORMACION PROVEEDOR</strong></div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-12">
                                <label for="inputProveedor" class="control-label mb-1">Proveedor:</label>
                                <div class="input-group">
                                    <select name="com_idProveedor" id="inputProveedor" class="form-control">
                                        <option selected>Seleccione un proveedor</option>
                                        <?php foreach($listProveedor as $proveedor):?>
                                            <option value='<?=$proveedor['prov_id']?>'><?=$proveedor['prov_empresa']?></option>
                                        <?php endforeach;?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <label for="inputFecha" class="col-sm-12 col-form-label">Fecha de compra:</label>
                            <div class="col-12">
                                <input type="date" id="inputFecha" name="com_fecha" class="form-control" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="card col-6">
                    <div class="card-header"><strong>INFORMACION PRODUCTO</strong></div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-12">
                                <label for="inputProducto" class="control-label mb-1">Producto:</label>
                                <div class="input-group">
                                    <select name="sum_idProducto" id="inputProducto" class="form-control">
                                        <option selected>Seleccione un producto</option>
                                        <?php foreach($listProductos as $producto):?>
                                            <option value='<?= $producto['pro_id'] ?>' ><?=$producto['pro_nombre']?></option>
                                        <?php endforeach;?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-12">
                                <label for="inputCantidad" class="control-label mb-1">Cantidad: </label>
                                <div class="input-group">
                                    <input type="number" name="sum_cantidad" id="inputCantidad" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-12">
                                <label for="inputPrecio" class="control-label mb-1">Precio por unidad: </label>
                                <div class="input-group">
                                    <input type="number" name="sum_precioUnitario" id="inputPrecio" class="form-control">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-3">
                <button type="submit" class="btn btn-primary">Guardar Compra</button>
            </div>
        </form>
    </div>
</div>