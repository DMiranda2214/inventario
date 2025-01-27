<br>
<div class="card">
    <div class="card-header">
        <strong>Nuevo Usuario</strong>
    </div>
    <div class="card-body">
        <form action="/inventario/public/Usuarios/insert" class="form-horizontal" method="post">
            <div class="row mb-3">
                <div class="col-6">
                    <label class="col-lg-3 control-label" for="inputUserNombre">Nombre</label>
                    <div class="input-group">
                        <input type="text" name="usu_nombre" class="form-control" id="inputUserNombre" placeholder="Nombre del Usuario">
                    </div>
                </div>
                <div class="col-6">
                    <label class="col-lg-3 control-label" for="inputUserCuenta">Usuario de acceso</label>
                    <div class="input-group">
                        <input type="text" name="usu_cuenta" class="form-control" id="inputUserCuenta" placeholder="Cuenta de autenticacion">
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-6">
                    <label class="col-lg-3 control-label" for="inputUserEmail">Correo</label>
                    <div class="input-group">
                        <input type="email" name="usu_email" class="form-control" id="inputUserEmail" placeholder="Correo del usuario">
                    </div>
                </div>
                <div class="col-6">
                    <label class="col-lg-3 control-label" for="inputUserPassword">Contraseña de acceso</label>
                    <div class="input-group">
                        <input type="password" name="usu_password" class="form-control" id="inputUserPassword" placeholder="Contraseña de autenticacion">
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <div class="form-group">
                    <div class="col-lg-offset-2 col-lg-10">
                        <button type="submit" class="btn btn-primary">Agregar Usuario</button>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>