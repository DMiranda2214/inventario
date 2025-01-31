<br><br>
<div class="card">
    <div class="card-header">
        REPORTE DE COMPRAS
    </div>
    <div class="card-body">
        <form action="/inventario/public/compras/generatePDFBuy" method="POST">
            <div class="row mb-3">
                <div class="col-6">
                    <label class="col-lg-3 control-label" for="inlineFormInputGroupStartDate">Fecha de inicio</label>
                    <div class="input-group">
                        <input required type="date" name="fechaInicio" class="form-control" id="inlineFormInputGroupStartDate" placeholder="Fecha de inicio">
                    </div>
                </div>
                <div class="col-6">
                    <label class="col-lg-3 control-label" for="inlineFormInputGroupEndDate">Fecha de fin</label>
                    <div class="input-group">
                        <input required type="date" name="fechaFin" class="form-control" id="inlineFormInputGroupEndDate" placeholder="Fecha de fin">
                    </div>
                </div>
            </div>
            <div class="row mb-3">
                <div class="col-12">
                    <button type="submit" class="btn btn-primary">Generar Reporte</button>
                </div>
            </div>
        </form>
    </div>
</div>