<div class="card">
    <h4 class="card-header">Actividades</h4>
    <div class="card-body">
        <div id="vista" class="row">
            <div class="col-12">
                <?= \Jida\Medios\Mensajes::imprimirMsjSesion() ?>
            </div>
            <div class="col-lg-3">
                <div class="btn-group" role="group" aria-label="Button group with nested dropdown">
                    <a href="<?= \Jida\Manager\Estructura::$urlBase ?>/jadmin/actividades/gestion/"
                       class="btn btn-primary" title="Agregar Actividad"><i class="fas fa-plus"></i> Agregar</a>
                    <?php if ($this->googleDriveActivo) : ?>
                        <a href="<?= \Jida\Manager\Estructura::$urlBase ?>/jadmin/google-drive/" class="btn btn-primary"
                           title="Exportar a Drive"><i class="fab fa-google-drive"></i></a>
                    <?php endif; ?>
                    <a href="<?= \Jida\Manager\Estructura::$urlBase ?>/jadmin/spread-sheet/actividades"
                       id="exportar-exel" class="btn btn-secondary" title=" Exportar a Excel"><i
                                class="fas fa-file-excel"></i> Exportar</a>
                </div>
            </div>
            <div class="col-lg-9">
                <div class="pb-3">
                    <form class="form-row text-right">
                        <div class="col">
                            <select id="empresa" class="form-control">
                                <option value>- Empresa -</option>
                            </select>
                        </div>
                        <div class="col">
                            <select id="centrocosto" class="form-control">
                                <option value>- Centro Costo -</option>
                            </select>
                        </div>
                        <div class="col">
                            <select id="responsable" class="form-control">
                                <option value>- Responsable -</option>
                            </select>
                        </div>
                        <div class="col">
                            <input id="fecha-inicio" class="form-control" type="date" placeholder="Fecha Inicio">
                        </div>
                        <div class="col">
                            <input id="fecha-fin" class="form-control" type="date" placeholder="Fecha Final">
                        </div>
                        <div class="col">
                            <button id="btn-busqueda" type="button" class="btn btn-primary">Filtrar</button>
                        </div>
                    </form>
                </div>
            </div>

            <div class="col-12 p-0 mt-3">

                <table id="actividadesTable" class="datatable table table-striped table-bordered mt-3">
                    <thead>
                    <tr class="info">
                        <th>Descripción</th>
                        <th>Horas</th>
                        <th>Fecha de inicio</th>
                        <th>Fecha de entrega</th>
                        <th>Empresa</th>
                        <th>Centro de costo</th>
                        <th>Subcentro de costo</th>
                        <th>Responsable</th>
                        <th>Opciones</th>
                    </tr>
                    </thead>
                    <tfoot>
                    <tr>
                        <th colspan="8" style="text-align:right">Total horas:</th>
                        <th></th>
                    </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>
</div>
