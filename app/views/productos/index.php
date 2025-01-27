<?php

use App\Controllers\ProductosController;

$productosController = new ProductosController();

$page = 1;
if (isset($_GET["page"])) {
    $page = $_GET["page"];
}
$limit = 3;
if (isset($_GET["limit"]) && $_GET["limit"] != "" && $_GET["limit"] != $limit) {
    $limit = $_GET["limit"];
}

function getPagination($page, $limit, $totalProducts)
{
    $totalPages = ceil($totalProducts / $limit);
    if ($totalPages <= 1) {
        return "";
    }
    $pagination = "";
    for ($i = 1; $i <= $totalPages; $i++) {
        if ($i == $page) {
            $pagination .= "<span class='btn btn-primary'>$i</span>";
        } else {
            $pagination .= "<a href='/inventario/public/Productos/index?page=$i&limit=$limit' class='btn btn-secondary'>$i</a>";
        }
    }
    return $pagination;
}

$totalProducts = $productosController->countProducts();
$productos = $productosController->getTotalProductsByPage($page, $limit);
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