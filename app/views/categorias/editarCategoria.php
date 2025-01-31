<?php 
use App\Controllers\CategoriasController;
$categoriaController = new CategoriasController();
$categoria = $categoriaController->getById($_GET['cat_id']);
?>
<div class="row">
    <div class="col-md-12">
        <br>
        <div class="card">
            <div class="card-header">
                EDITAR CATEGORIA
            </div>
            <div class="card-body">
                <form class="form-horizontal" method="POST" action="/inventario/public/Categorias/edit" role="form">
                    <div class="form-group">
                        <label for="inputEmail1" class="col-lg-2 control-label"><p>Nombre</p></label>
                        <div class="col-md-6">
                            <input type="text" name="cat_nombre" required class="form-control" id="name" placeholder="Nombre" value="<?= $categoria['cat_nombre'] ?>" required>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="inlineFormInputCategoryDescription" class="col-lg-2 control-label">Descripcion</label>
                        <div class="col-md-6">
                            <textarea type="text" name="cat_descripcion" class="form-control"  id="inlineFormInputCategoryDescription" placeholder="Descripcion de la categoria" required><?= $categoria['cat_descripcion']?></textarea>
                        </div>
                    </div>
                    <br>
                    <div class="form-group">
                        <div class="col-lg-offset-2 col-lg-10">
                            <input type="text" hidden name="cat_id" value="<?= $categoria['cat_id'] ?>">
                            <button type="submit" class="btn btn-primary">Editar Categoria</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>