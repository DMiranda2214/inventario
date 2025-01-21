<?php
use App\Controllers\CategoriaController;
$categoriaController = new CategoriaController();
$listCategories = $categoriaController->getNameCategories()
?>
<div class="card">
    <div class="card-header">
        <strong>Nuevo Producto</strong>
    </div>
    <div class="card-body">
        <form action="/inventario/public/Productos/insert" method="POST" class="form-horizontal">
            <div class="row mb-3">
                <div class="col-6">
                    <label class="visually-hidden" for="inlineFormInputGroupUsername">Nombre</label>
                    <div class="input-group">
                        <div class="input-group-text">Nombre</div>
                        <input type="text" name="nombre" class="form-control" id="inlineFormInputGroupUsername" placeholder="Nombre del producto">
                    </div>
                </div>
                <div class="col-6">
                    <label class="visually-hidden" for="inlineFormInputGroupCategoria">Categoria</label>
                    <div class="input-group">
                        <div class="input-group-text">Categoria</div>
                        <select class="form-select" name="categoria" id="inlineFormInputGroupCategoria">
                            <option selected>Seleccione Categoria</option>
                            <?php foreach($listCategories as $category):?>
                                <option value='<?=$category['id']?>'><?=$category['name']?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-12">
                    <label class="visually-hidden" for="inlineFormInputGroupDescription">Descripción</label>
                    <div class="input-group">
                        <div class="input-group-text">Descripción</div>
                        <textarea type="text" name="description" class="form-control"  id="inlineFormInputGroupDescription" placeholder="Descripcion del producto"></textarea>
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-6">
                    <label class="visually-hidden" for="inlineFormInputGroupShopPrice">Precio de compra</label>
                    <div class="input-group">
                        <div class="input-group-text">$</div>
                        <input type="number" name="priceShop" class="form-control" id="inlineFormInputGroupShopPrice" placeholder="Precio de compra">
                    </div>
                </div>
                <div class="col-6">
                    <label class="visually-hidden" for="inlineFormInputGroupInventoryStart">Cantidad Inicial</label>
                    <div class="input-group">
                        <div class="input-group-text">Cantidad Inicial</div>
                        <input type="number" name="inventoryInit" class="form-control" id="inlineFormInputGroupInventoryStart" placeholder="Cantidad Inicial">
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-6">
                    <label class="visually-hidden" for="inlineFormInputGroupSellPrice">Precio de venta</label>
                    <div class="input-group">
                        <div class="input-group-text">$</div>
                        <input type="number" name="priceSell" class="form-control" id="inlineFormInputGroupSellPrice" placeholder="Precio de venta">
                    </div>
                </div>
                <div class="col-6">
                    <label class="visually-hidden" for="inlineFormInputGroupInventoryMin">Cantidad Minima</label>
                    <div class="input-group">
                        <div class="input-group-text">Cantidad Minima</div>
                        <input type="number" name="inventoryMin" class="form-control" id="inlineFormInputGroupInventoryMin" placeholder="Cantidad Minima (Default: 10)">
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