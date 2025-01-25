<?php

use App\Controllers\ComprasController;

$comprasController = new ComprasController();
$compra = $comprasController->getDetailBuy($_GET['com_id']);

?>
<br><br>
<div class="card">
    <div class="card-header"><strong>DETALLE COMPRA</strong></div>
    <div class="card-body">
        <div class="card mb-3">
            <div class="card-header"> <strong>INFORMACION DEL PROVEEDOR</strong> </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        <div class="input-group">
                            <label class="col-lg-3 control-label" for="inputEmpresa">Empresa: </label>
                            <div class="input-group">
                                <input type="text" name="prov_empresa" value="<?= $compra['prov_empresa'] ?>" id="inputEmpresa" class="form-control" placeholder="Nombre del empresa" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <label for="inputFecha" class="">Fecha de compra:</label>
                        <input type="date" id="inputFecha" name="com_fecha" value="<?= $compra['com_fecha'] ?>" class="form-control" disabled>
                    </div>
                </div>
                <div class="row mt-3 mb-3">
                    <div class="col-6">
                        <div class="input-group">
                            <label class="col-lg-3 control-label" for="inputVendedor">Vendedor: </label>
                            <div class="input-group">
                                <input type="text" name="prov_vendedor" value="<?= $compra['prov_vendedor'] ?>" id="inputVendedor" class="form-control" placeholder="Nombre del vendedor" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <label for="inputDireccion" class="">Direccion:</label>
                        <input type="text" id="inputDireccion" name="dPro_direccion" value="<?= $compra['dPro_direccion'] ?>" class="form-control" placeholder="Direccion de la empresa" disabled>
                    </div>
                </div>
            </div>
        </div>
        <div class="card">
            <div class="card-header"><strong>DETALLE DE LA COMPRA</strong></div>
            <div class="card-body">
                <div class="row">
                    <div class="col-6">
                        <div class="input-group">
                            <label for="inputProducto" class="control-label">Producto: </label>
                            <div class="input-group">
                                <input type="text" name="pro_nombre" value="<?= $compra['pro_nombre'] ?>" id="inputProducto" class="form-control" placeholder="Nombre del producto" disabled>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <label for="inputCantidad" class="">Cantidad: </label>
                        <input type="number" name="sum_cantidad" value="<?= $compra['sum_cantidad'] ?>" id="inputCantidad" class="form-control" placeholder="Cantidad" disabled>
                    </div>
                </div>
                <div class="row mt-3">
                    <div class="col-6">
                        <label for="inputPrecio" class="">Precio por unidad: </label>
                        <div class="input-group">
                            <div class="input-group-text">$</div>
                            <input type="text" name="sum_precioUnitario" value="<?= number_format($compra['sum_precioUnitario']) ?>" id="inputPrecio" class="form-control" placeholder="Precio" disabled>
                        </div>
                    </div>
                    <div class="col-6">
                        <label for="inputTotal" class="">Total: </label>
                        <div class="input-group">
                            <div class="input-group-text">$</div>
                            <input type="text" name="sum_subTotal" value="<?php echo number_format($compra['sum_subTotal']) ?>" id="inputTotal" class="form-control" placeholder="Total" disabled>
                        </div>
                    </div>
                </div>

            </div>
        </div>
        <br>
    </div>
</div>