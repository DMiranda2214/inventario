<br>
<div class="card">
    <div class="card-header">
        <strong>Nuevo Proveedor</strong>
    </div>
    <div class="card-body">
        <form action="/inventario/public/Proveedor/insert" class="form-horizontal" method="post">
            <div class="row mb-3">
                <div class="col-6">
                    <label class="col-lg-3 control-label" for="inputProveedorEmpresa">Empresa</label>
                    <div class="input-group">
                        <input type="text" name="prov_empresa" class="form-control" id="inputProveedorEmpresa" placeholder="Empresa Proveedora">
                    </div>
                </div>
                <div class="col-6">
                    <label class="col-lg-3 control-label" for="inputProveedorVendedor">Vendedor</label>
                    <div class="input-group">
                        <input type="text" name="prov_vendedor" class="form-control" id="inputProveedorVendedor" placeholder="Nombre del Proveedor">
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-6">
                    <label class="col-lg-3 control-label" for="inputProveedorTelefono">Telefono</label>
                    <div class="input-group">
                        <input type="text" name="prov_telefono" class="form-control" id="inputProveedorTelefono" placeholder="Telefono de contacto">
                    </div>
                </div>
                <div class="col-6">
                    <label class="col-lg-3 control-label" for="inputProveedorDireccion">Direccion</label>
                    <div class="input-group">
                        <input type="text" name="prov_direccion" class="form-control" id="inputProveedorDireccion" placeholder="Direccion de la empresa">
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-12">
                    <label class="col-lg-3 control-label" for="inputProveedorEmail">Correo</label>
                    <div class="input-group">
                        <input type="text" name="prov_email" class="form-control" id="inputProveedorEmail" placeholder="Email de contacto">
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <div class="form-group">
                    <div class="col-lg-offset-2 col-lg-10">
                        <button type="submit" class="btn btn-primary">Agregar Proveedor</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>