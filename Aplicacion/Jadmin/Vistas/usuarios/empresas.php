<div class="card">
    <h4 class="card-header">Empresas de usuario: <?= $this->nombre ?></h4>
    <div class="card-body">
        <div id="vista" class="row">
            <div class="col-12">
                <?= \Jida\Medios\Mensajes::imprimirMsjSesion() ?>
            </div>
            <div class="col-12">
                <form action="<?= \Jida\Manager\Estructura::$urlBase ?>/jadmin/usuarios/empresas/<?= $this->id_usuario ?>"
                      method="post">
                    <?php foreach ($this->empresas as $empresa): ?>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input"
                                   type="checkbox"
                                   name="id_empresa[]"
                                   value="<?= $empresa['id_empresa'] ?>"
                                   id="defaultCheck<?= $empresa['id_empresa'] ?>"
                                <?= array_intersect([$empresa['id_empresa']], $this->listadoEmpresas) ? 'checked' : null ?>>
                            <label class="form-check-label" for="defaultCheck<?= $empresa['id_empresa'] ?>">
                                <?= $empresa['empresa'] ?>
                            </label>
                        </div>
                    <?php endforeach; ?>
                    <div class="form-group text-right">
                        <button type="submit" name="btnGestionEmpresas" class="btn btn-primary" value="true">
                            Guardar
                        </button>
                        <a href="<?= \Jida\Manager\Estructura::$urlBase ?>/jadmin/usuarios" class="btn btn-primary">
                            Volver a Usuarios
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>