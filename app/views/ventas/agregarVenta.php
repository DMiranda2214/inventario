<?php

use App\Controllers\ClientesController;
use App\Controllers\ProductosController;

$clientesController = new ClientesController();
$productosController = new ProductosController();

$listClientes = $clientesController->get();
$listProductos = $productosController->getProductsToSell();
?>

<br>
<div class="card">
    <div class="card-header">
        <strong>INFORMACION VENTA</strong>
    </div>
    <div class="card-body">
        <form action="/inventario/public/Ventas/insert" method="POST">
            <div class="d-flex mb-3">
                <div class="card col-6 me-2">
                    <div class="card-header"><strong>INFORMACION CLIENTE</strong></div>
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-12">
                                <label class="col-lg-3 control-label" for="inputCliente">Cliente:</label>
                                <div class="input-group">
                                    <select class="form-select" name="ven_idCliente" id="inputCliente">
                                        <option selected disabled>Seleccione Cliente</option>
                                        <?php foreach ($listClientes as $cliente): ?>
                                            <option value='<?= $cliente['cli_id'] ?>'><?= $cliente['cli_nombre'] ?> <?= $cliente['cli_apellido'] ?></option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-12">
                                <label for="inputFecha" class="col-sm-12 col-form-label">Fecha de venta:</label>
                                <input type="date" id="inputFecha" name="ven_fecha" class="form-control" required>
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
                                        <option selected disabled>Seleccione un producto</option>
                                        <?php foreach ($listProductos as $producto): ?>
                                            <option
                                                value="<?= $producto['pro_id'] ?>"
                                                data-stock="<?= $producto['inv_Stock'] ?>">
                                                <?= $producto['pro_nombre'] ?>
                                            </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="row mb-3">
                            <div class="col-12">
                                <label for="inputCantidad" class="control-label mb-1">Cantidad: </label>
                                <div class="input-group">
                                    <input type="number" name="sum_cantidad" id="inputCantidad" class="form-control" placeholder="Seleccione un producto para ver la cantidad máxima" required>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="mt-3">
                <button type="submit" class="btn btn-primary">Guardar Venta</button>
            </div>
        </form>
    </div>
</div>
<script>
    // Obtener elementos del DOM
    const inputProducto = document.getElementById('inputProducto');
    const inputCantidad = document.getElementById('inputCantidad');

    // Escuchar el evento de cambio en el select
    inputProducto.addEventListener('change', function() {
        // Obtener el stock máximo del producto seleccionado
        const selectedOption = inputProducto.options[inputProducto.selectedIndex];
        const maxStock = selectedOption.getAttribute('data-stock');

        // Actualizar el placeholder del input de cantidad
        if (maxStock) {
            inputCantidad.placeholder = `Cantidad max: ${maxStock}`;
            inputCantidad.max = maxStock; // Establecer un máximo para el input
        } else {
            inputCantidad.placeholder = "Seleccione un producto para ver la cantidad máxima";
            inputCantidad.removeAttribute('max'); // Quitar restricción si no hay stock
        }
    });
</script>