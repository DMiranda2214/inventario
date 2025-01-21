<?php 
    use App\Controllers\ProductosController;
    $productosController = new ProductosController();

    $page = 1;
    if(isset($_GET["page"])){
        $page=$_GET["page"];
    }
    $limit=3;
    if(isset($_GET["limit"]) && $_GET["limit"]!="" && $_GET["limit"]!=$limit){
        $limit=$_GET["limit"];
        }

    function getPagination($page, $limit, $totalProducts){
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

<div class="row">
    <div class="col-md-12">
        <h3>Productos</h3>
    </div>
    <br><br>
    <div>
        <a href="/inventario/public/Productos/agregarProducto" class="btn btn-secondary">Agregar Producto</a>
    </div>
    <br><br>
    <div class="card">
        <div class="card-header">Productos</div>
        <div class="card body">
            <table class="table table-striped-columns table-hover">
                <thead>
                    <tr>
                        <th scope="col">Codigo</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Descripción</th>
                        <th scope="col">Precio</th>
                        <th scope="col">Stock</th>
                        <th scope="col">Acciones</th>
                    </tr>
                </thead>
                <tbody class="table-group-divider">
                    <?php foreach($productos as $producto): ?>
                        <tr>
                            <th scope="row"><?= $producto['id'] ?></th>
                            <td><?= $producto['name'] ?></td>
                            <td><?= $producto['description'] ?></td>
                            <td><?= $producto['price'] ?></td>
                            <td><?= $producto['stock'] ?></td>
                            <td>
                                <a href="" class="btn btn-secondary">Editar</a>
                                <a href="" class="btn btn-danger">Eliminar</a>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                </tbody>
            </table>
            <div class="pagination">
                <?= getPagination($page, $limit, $totalProducts); ?>
            </div>
        </div>
    </div>
</div>