<?php

use Jida\Medios\Mensajes;

?>
<div class="container">
    <div class="card">
        <h4 class="card-header">Clientes</h4>
        <div class="card-body">
            <div class="row">
                <div class="col-12">
                    <?= Mensajes::imprimirMsjSesion() ?>
                </div>
                <div class="col-12">
                    <?= $this->vista ?>
                </div>
            </div>
        </div>
    </div>
</div>