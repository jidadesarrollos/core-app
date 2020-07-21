<?php

use Jida\Medios\Mensajes;

?>
<div class="card">
    <h4 class="card-header">Transacciones</h4>
    <div class="card-body">
        <div class="row">
            <div class="col-md-12">
                <?= Mensajes::imprimirMsjSesion() ?>
            </div>
            <div class="col-md-12">
                <?= $this->vista ?>
            </div>
        </div>
    </div>
</div>