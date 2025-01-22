<div class="row">
    <div class="col-md-12">
        <br>
        <div class="card">
            <div class="card-header">
                NUEVA CATEGORIA
            </div>
            <div class="card-body">
                <form class="form-horizontal" method="POST" action="/inventario/public/Categorias/insert" role="form">
                    <div class="form-group">
                        <label for="inputEmail1" class="col-lg-2 control-label">Nombre</label>
                        <div class="col-md-6">
                            <input type="text" name="cat_nombre" required class="form-control" id="name" placeholder="Nombre">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="" class="col-lg-2 control-label">Descripcion</label>
                        <div class="col-md-6">
                            <textarea name="cat_descripcion" id=""></textarea>
                        </div>
                    </div>
                    <br>
                    <div class="form-group">
                        <div class="col-lg-offset-2 col-lg-10">
                            <button type="submit" class="btn btn-primary">Agregar Categoria</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>