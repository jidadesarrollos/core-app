<div class="card">
    <h4 class="card-header">Gestion de Empresas</h4>
    <div class="card-body">
        <div id="vista" class="row">
            <div class="col-12">
                <?= \Jida\Medios\Sesion::obt('__msj') ?>
            </div>
            <div class="col-lg-6 col-md-12">
                <?= $this->vista ?>
            </div>
        </div>
    </div>
</div>
