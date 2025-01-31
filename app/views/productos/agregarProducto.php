<?php
use App\Controllers\CategoriasController;
$categoriaController = new CategoriasController();
$listCategories = $categoriaController->get()
?>
<br>
<div class="card">
    <div class="card-header">
        <strong>Nuevo Producto</strong>
    </div>
    <div class="card-body">
        <form action="/inventario/public/Productos/insert" method="POST" class="form-horizontal">
            <div class="row mb-3">
                <div class="col-6">
                    <label class="col-lg-3 control-label" for="inlineFormInputGroupUsername">Nombre</label>
                    <div class="input-group">
                        <input required type="text" name="pro_nombre" class="form-control" id="inlineFormInputGroupUsername" placeholder="Nombre del producto">
                    </div>
                </div>
                <div class="col-6">
                    <label class="col-lg-3 control-label" for="inlineFormInputGroupCategoria">Categoria</label>
                    <div class="input-group">
                        <select class="form-select" name="pro_idCategoria" id="inlineFormInputGroupCategoria" required>
                            <option value="" selected disabled>Seleccione Categoria</option>
                            <?php foreach($listCategories as $category):?>
                                <option value='<?=$category['cat_id']?>'><?=$category['cat_nombre']?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-12">
                    <label class="col-lg-3 control-label" for="inlineFormInputGroupDescription">Descripción</label>
                    <div class="input-group">
                        <textarea required type="text" name="pro_descripcion" class="form-control"  id="inlineFormInputGroupDescription" placeholder="Descripcion del producto"></textarea>
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-6">
                    <label class="col-lg-3 control-label" for="inlineFormInputGroupSellPrice">Precio de venta</label>
                    <div class="input-group">
                        <div class="input-group-text">$</div>
                        <input required type="number" name="pro_precioVenta" class="form-control" id="inlineFormInputGroupSellPrice" placeholder="Precio de venta">
                    </div>
                </div>
                <div class="col-6">
                    <label class="col-lg-3 control-label" for="inlineFormInputGroupInventoryMin">Cantidad Minima</label>
                    <div class="input-group">
                        <div class="input-group-text">UND</div>
                        <input required type="number" name="pro_cantMin" class="form-control" id="inlineFormInputGroupInventoryMin" placeholder="Cantidad Minima (Default: 10)">
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <div class="form-group">
                    <div class="col-lg-offset-2 col-lg-10">
                        <button type="submit" class="btn btn-primary">Agregar Producto</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>