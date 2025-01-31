<?php
    use App\Controllers\ClientesController;
    $clientesController = new ClientesController();
    $cliente = $clientesController->getById($_GET['cli_id']);
?>


<br>
<div class="card">
    <div class="card-header">
        <strong>Editar Cliente</strong>
    </div>
    <div class="card-body">
        <form action="/inventario/public/Clientes/edit" class="form-horizontal" method="post">
            <div class="row mb-3">
                <div class="col-6">
                    <label class="col-lg-3 control-label" for="inputClientNombre">Nombre</label>
                    <div class="input-group">
                        <input required type="text" name="cli_nombre"  value="<?= $cliente['cli_nombre'] ?>" disabled class="form-control" id="inputClientNombre" placeholder="Nombre del cliente">
                    </div>
                </div>
                <div class="col-6">
                    <label class="col-lg-3 control-label" for="inputClientApellido">Apellido</label>
                    <div class="input-group">
                        <input required type="text" name="cli_apellido" value="<?= $cliente['cli_apellido'] ?>" disabled class="form-control" id="inputClientApellido" placeholder="Apellido del cliente">
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-6">
                    <label class="col-lg-3 control-label" for="inputClientTelefono">Telefono</label>
                    <div class="input-group">
                        <input required type="text" name="cli_telefono" value="<?= $cliente['tCli_telefono'] ?>" class="form-control" id="inputClientTelefono" placeholder="Telefono del cliente">
                    </div>
                </div>
                <div class="col-6">
                    <label class="col-lg-3 control-label" for="inputClientDireccion">Direccion</label>
                    <div class="input-group">
                        <input required type="text" name="cli_direccion" value="<?= $cliente['dCli_direccion'] ?>" class="form-control" id="inputClientDireccion" placeholder="Direccion del cliente">
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-12">
                    <label class="col-lg-3 control-label" for="inputClientEmail">Email</label>
                    <div class="input-group">
                        <input required type="text" name="cli_email" value="<?= $cliente['cli_email'] ?>" class="form-control" id="inputClientEmail" placeholder="Email del cliente">
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <div class="form-group">
                    <div class="col-lg-offset-2 col-lg-10">
                        <input required type="text" hidden name="cli_id" value="<?= $cliente['cli_id'] ?>">
                        <button type="submit" class="btn btn-primary">Editar Cliente</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>