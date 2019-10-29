<div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom shadow-sm">
    <h5 class="my-0 mr-md-auto font-weight-normal"><?= $this->nombreApp; ?></h5>
    <nav class="my-2 my-md-0 mr-md-3">
        <a class="p-2 text-dark" href="<?= $this->navegar() ?>"><?= $this->texto('m_inicio') ?></a>
        <a class="p-2 text-dark" href="<?= $this->navegar('/biografia') ?>"><?= $this->texto('m_biografia') ?></a>
        <a class="p-2 text-dark" href="<?= $this->cambiarIdioma('es') ?>">Español</a>
        <a class="p-2 text-dark" href="<?= $this->cambiarIdioma('en') ?>">English</a>
    </nav>
</div>