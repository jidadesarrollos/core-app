<div class="card">
    <h4 class="card-header">Gestion de Actividades</h4>
    <div class="card-body">
        <div class="row">
            <div class="col-6">
                <?= \Jida\Medios\Mensajes::imprimirMsjSesion() ?>
            </div>
        </div>
        <div class="row">
            <div class="col-md-6">
                <?= $this->msj ?>
                <?= $this->form ?>
            </div>
            <div class="col-md-6">
                <h4 class="text-center">Últimas Actividades</h4>
                <div class="list-group">
                    <?php foreach ($this->actividadesUsuario as $actividad): ?>
                        <li class="list-group-item">
                            <p class="m-0 d-flex align-items-center">
                                <span><?= $actividad['fecha_inicio'] ?> a <?= $actividad['fecha_entrega'] ?></span>
                                <span class="badge badge-pill badge-primary ml-1 mr-1">
                                    <?= $actividad['centro_costo'] ?>
                                </span>
                                <span class="flex-grow-1"></span>
                                <span class="text-small text-muted ml-auto">
                                    <?= $actividad['horas'] ?> horas
                                </span>
                            </p>
                            <p class="text-small text-muted m-0"><?= $actividad['descripcion'] ?></p>
                        </li>
                    <?php endforeach; ?>
                </div>
            </div>
        </div>
    </div>
</div>