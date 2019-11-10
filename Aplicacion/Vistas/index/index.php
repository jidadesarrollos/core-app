<?php

?>
<div
    id="app" class="jumbotron" data-usuarios='<?= json_encode($this->usuarios) ?>'>
    <h2><?= $this->texto('titulo_miembros') ?></h2>
    <p><?= $this->texto('texto') ?></p>
</div>