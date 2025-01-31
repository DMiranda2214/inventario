<?php
    use App\Controllers\ProveedorController;
    $proveedorController = new ProveedorController();
    $proveedor = $proveedorController->getById($_GET['prov_id']);
?>

<br>
<div class="card">
    <div class="card-header">
        <strong>Editar Proveedor</strong>
    </div>
    <div class="card-body">
        <form action="/inventario/public/Proveedor/edit" class="form-horizontal" method="post">
            <div class="row mb-3">
                <div class="col-6">
                    <label class="col-lg-3 control-label" for="inputProveedorEmpresa">Empresa</label>
                    <div class="input-group">
                        <input required type="text" name="prov_empresa" disabled value="<?= $proveedor['prov_empresa'] ?>" class="form-control" id="inputProveedorEmpresa" placeholder="Empresa Proveedora">
                    </div>
                </div>
                <div class="col-6">
                    <label class="col-lg-3 control-label" for="inputProveedorVendedor">Vendedor</label>
                    <div class="input-group">
                        <input required type="text" name="prov_vendedor" value="<?= $proveedor['prov_vendedor'] ?>" class="form-control" id="inputProveedorVendedor" placeholder="Nombre del Proveedor">
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-6">
                    <label class="col-lg-3 control-label" for="inputProveedorTelefono">Telefono</label>
                    <div class="input-group">
                        <input required type="text" name="prov_telefono" value="<?= $proveedor['tPro_telefono'] ?>" class="form-control" id="inputProveedorTelefono" placeholder="Telefono de contacto">
                    </div>
                </div>
                <div class="col-6">
                    <label class="col-lg-3 control-label" for="inputProveedorDireccion">Direccion</label>
                    <div class="input-group">
                        <input required type="text" name="prov_direccion" value="<?= $proveedor['dPro_direccion'] ?>" class="form-control" id="inputProveedorDireccion" placeholder="Direccion de la empresa">
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-12">
                    <label class="col-lg-3 control-label" for="inputProveedorEmail">Correo</label>
                    <div class="input-group">
                        <input required type="text" name="prov_email" value="<?= $proveedor['prov_email'] ?>" class="form-control" id="inputProveedorEmail" placeholder="Email de contacto">
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <div class="form-group">
                    <div class="col-lg-offset-2 col-lg-10">
                        <input required type="text" hidden name="prov_id" value="<?= $proveedor['prov_id'] ?>">
                        <button type="submit" class="btn btn-primary">Editar Proveedor</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>