<div class="card">
    <h4 class="card-header">Centro Costos</h4>
    <div class="card-body">
        <div id="vista" class="row">
            <div class="col-12">
                <?= \Jida\Medios\Mensajes::imprimirMsjSesion() ?>
            </div>
            <div class="col-12">
                <a href="<?= \Jida\Manager\Estructura::$urlBase ?>/jadmin/centros-costos/gestion/"
                   class="btn btn-primary btn-vista">
                    Agregar Centro de Costo
                </a>
            </div>
            <div class="col-12 p-0 mt-3">
                <table id="centroCostosTable" class="datatable table table-striped table-bordered mt-3">
                    <thead>
                    <tr class="info">
                        <th>Centro de Costo</th>
                        <th>Horas</th>
                        <th>Opciones</th>
                    </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</div>