<?php 
    use App\Controllers\CategoriasController;
    use App\Controllers\ProductosController;
    $productoController = new ProductosController();
    $categoriaController = new CategoriasController();
    $producto = $productoController->getByid($_GET['pro_id']);
    $categorias = $categoriaController->get();
?>
<br>
<div class="card">
    <div class="card-header">
        <strong>Nuevo Producto</strong>
    </div>
    <div class="card-body">
        <form action="/inventario/public/Productos/edit" method="POST" class="form-horizontal">
            <div class="row mb-3">
                <div class="col-6">
                    <label class="col-lg-3 control-label" for="inlineFormInputGroupUsername">Nombre</label>
                    <div class="input-group">
                        <input type="text" name="pro_nombre" value="<?= $producto['pro_nombre'] ?>" class="form-control" id="inlineFormInputGroupUsername" placeholder="Nombre del producto">
                    </div>
                </div>
                <div class="col-6">
                    <label class="col-lg-3 control-label" for="inlineFormInputGroupCategoria">Categoria</label>
                    <div class="input-group">
                        <select class="form-select" name="pro_idCategoria" id="inlineFormInputGroupCategoria">
                            <?php foreach($categorias as $categoria):
                                    if($categoria['cat_id'] == $productos['pro_idCategoria']):
                                        echo "<option value='".$categoria['cat_id']."' selected>".$categoria['cat_nombre']."</option>";
                            ?>
                            <?php 
                                    else:
                            ?>
                                <option value='<?=$categoria['cat_id']?>'><?=$categoria['cat_nombre']?></option>
                            <?php 
                                    endif;
                                endforeach; 
                            ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-12">
                    <label class="col-lg-3 control-label" for="inlineFormInputGroupDescription">Descripción</label>
                    <div class="input-group">
                        <textarea type="text" name="pro_descripcion" class="form-control"  id="inlineFormInputGroupDescription" placeholder="Descripcion del producto"><?= $producto['pro_descripcion']?></textarea>
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-6">
                    <label class="col-lg-3 control-label" for="inlineFormInputGroupSellPrice">Precio de venta</label>
                    <div class="input-group">
                        <div class="input-group-text">$</div>
                        <input type="number" name="pro_precioVenta" value="<?= $producto['pro_precioVenta'] ?>" class="form-control" id="inlineFormInputGroupSellPrice" placeholder="Precio de venta">
                    </div>
                </div>
                <div class="col-6">
                    <label class="col-lg-3 control-label" for="inlineFormInputGroupInventoryMin">Cantidad Minima</label>
                    <div class="input-group">
                        <div class="input-group-text">UND</div>
                        <input type="number" name="pro_cantMin" value="<?= $producto['pro_cantMin'] ?>" class="form-control" id="inlineFormInputGroupInventoryMin" placeholder="Cantidad Minima (Default: 10)">
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <div class="form-group">
                    <div class="col-lg-offset-2 col-lg-10">
                        <input type="text" hidden name="pro_id" value="<?= $producto['pro_id'] ?>">
                        <button type="submit" class="btn btn-primary">Editar Producto</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>