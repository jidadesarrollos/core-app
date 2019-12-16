<div class="card">
    <h4 class="card-header">Sub Centro Costos</h4>
    <div class="card-body">
        <div id="vista" class="row">
            <div class="col-12">
                <?= \Jida\Medios\Mensajes::imprimirMsjSesion() ?>
            </div>
            <div class="col-12">
                <a href="/jadmin/sub-centros-costos/gestion/<?= $this->idfk ?>/" class="btn btn-primary">
                    Agregar Sub Centro de Costo
                </a>
            </div>
            <div class="col-12 p-0 mt-3">
                <table id="subCentroCostosTable" class="datatable table table-striped table-bordered mt-3"
                    <?= 'dataref="' . $this->idfk . '"' ?>>
                    <thead>
                    <tr class="info">
                        <th>SubCentro de Costo</th>
                        <th>Horas</th>
                        <th>Opciones</th>
                    </tr>
                    </thead>
                </table>
            </div>
            <div class="col-12">
                <a href="<?= $this->urlBase ?>/jadmin/centros-costos/" class="btn btn-primary pull-right">Volver a
                    Centro de Costos</a>
            </div>
        </div>
    </div>
</div>