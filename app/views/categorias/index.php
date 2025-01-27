
<?php 
use App\Controllers\CategoriasController;
$categoriaController = new CategoriasController();
$categorias = $categoriaController->get();
?>
<br>
<div class="">
	<a href="/inventario/public/Categorias/agregarCategoria" class="btn btn-primary"><i class='fa fa-th-list'></i> Nueva Categoria</a>
</div>
<br>
<div class="card">
    <div class="card-header">
        CATEGORIAS
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table align-middle table-bordered">
                <thead>
                    <th class="col-md-5">Nombre</th>
                    <th class="col-md-7">Descripcion</th>
                    <th>Editar</th>
                </thead>
                <tbody class="table-group-divider">
                    <?php foreach($categorias as $categoria): ?>
                    <tr>
                        <td><?= $categoria['cat_nombre'] ?></td>
                        <td><?= $categoria['cat_descripcion'] ?></td>
                        <td>
                            <a class="py-2 px-4 btn btn-info btn-xs" href="/inventario/public/Categorias/editarCategoria?cat_id=<?= $categoria['cat_id']?>">
                                <svg class="btn-icon" width="24" height="24">
                                    <use xlink:href="/inventario/public/icons/free.svg#cil-pencil"></use>
                                </svg> 
                            </a>
                        </td>
                    </tr>
                    <?php endforeach;?>
                </tbody>
            </table>
        </div>
    </div>
</div>