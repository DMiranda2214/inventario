<br>
<div>
    <a href="#" class="btn btn-primary">Agregar Proveedor</a>
</div>
<br>
<div class="card">
    <div class="card-header">CLIENTES</div>
    <div class="card-body">
        <div class="table-responsive col-md-12">
            <table class="table align-middle table-bordered">
                <thead>
                    <th class="col-md-3">Nombre</th>
                    <th class="col-md-5">Descripcion</th>
                    <th class="col-md-1">Precio</th>
                    <th class="col-md-1">Stock</th>
                    <th>Editar</th>
                    <th>Eliminar</th>
                </thead>
                <tbody class="table-group-divider">
                    <?php foreach ($proveedores as $proveedor): ?>
                        
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>