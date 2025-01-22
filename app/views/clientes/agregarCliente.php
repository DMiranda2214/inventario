<br>
<div class="card">
    <div class="card-header">
        <strong>Nuevo Cliente</strong>
    </div>
    <div class="card-body">
        <form action="/inventario/public/Clientes/insert" class="form-horizontal" method="post">
            <div class="row mb-3">
                <div class="col-6">
                    <label class="col-lg-3 control-label" for="inputClientNombre">Nombre</label>
                    <div class="input-group">
                        <input type="text" name="cli_nombre" class="form-control" id="inputClientNombre" placeholder="Nombre del cliente">
                    </div>
                </div>
                <div class="col-6">
                    <label class="col-lg-3 control-label" for="inputClientApellido">Apellido</label>
                    <div class="input-group">
                        <input type="text" name="cli_apellido" class="form-control" id="inputClientApellido" placeholder="Apellido del cliente">
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-6">
                    <label class="col-lg-3 control-label" for="inputClientTelefono">Telefono</label>
                    <div class="input-group">
                        <input type="text" name="cli_telefono" class="form-control" id="inputClientTelefono" placeholder="Telefono del cliente">
                    </div>
                </div>
                <div class="col-6">
                    <label class="col-lg-3 control-label" for="inputClientDireccion">Direccion</label>
                    <div class="input-group">
                        <input type="text" name="cli_direccion" class="form-control" id="inputClientDireccion" placeholder="Direccion del cliente">
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-12">
                    <label class="col-lg-3 control-label" for="inputClientEmail">Email</label>
                    <div class="input-group">
                        <input type="text" name="cli_email" class="form-control" id="inputClientEmail" placeholder="Email del cliente">
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