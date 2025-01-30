<?php

use App\Controllers\ProductosController;

$productosController = new ProductosController();

$productos = $productosController->get();
?>

<br>
<div>
    <a href="/inventario/public/Productos/agregarProducto" class="btn btn-primary">Agregar Producto</a>
</div>
<br>
<div class="card">
    <div class="card-header">PRODUCTOS</div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table align-middle table-bordered">
                <thead>
                    <th class="col-md-3">Nombre</th>
                    <th class="col-md-6">Descripcion</th>
                    <th class="col-md-2">Precio</th>
                    <th>Editar</th>
                </thead>
                <tbody class="table-group-divider">
                    <?php foreach ($productos as $producto): ?>
                        <tr>
                            <td><?= $producto['pro_nombre'] ?></td>
                            <td><?= $producto['pro_descripcion'] ?></td>
                            <td>$<?= number_format($producto['pro_precioVenta']) ?></td>
                            <td>
                                <a class="py-2 px-4 btn btn-info btn-xs" href="/inventario/public/Productos/editarProducto?pro_id=<?= $producto['pro_id'] ?>">
                                    <svg class="btn-icon" width="24" height="24">
                                        <use xlink:href="/inventario/public/icons/free.svg#cil-pencil"></use>
                                    </svg>
                                </a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>