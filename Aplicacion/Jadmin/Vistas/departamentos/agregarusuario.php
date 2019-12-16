<div class="card">
    <h4 class="card-header">Gestion de Usuarios del Departamento</h4>
    <div class="card-body">
        <div class="row">
            <div class="col-md-6">
                <form id="formUsuario" name="formUsuario" method="post" action="<?= $this->url; ?>">
                    <section class="col-md-12">
                        <div class="form-group">
                            <label for="id_usuario">
                                Usuario
                            </label>
                            <select id="id_usuario" name="id_usuario" class="form-control">
                                <option value="">Seleccione</option>
                                <?php foreach ($this->usuarios as $usuario): ?>
                                    <option value="<?= $usuario['id_usuario'] ?>" <?= in_array($usuario['id_usuario'], $this->miembros) ? 'disabled' : null ?>>
                                        <?= $usuario['nombres'] . " " . $usuario['apellidos'] ?>
                                    </option>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </section>
                    <section class="row">
                        <div class="col-md-12 col-md-12 text-right">
                            <div class="btn-group">
                                <input id="btnUsuario" name="btnUsuario" type="submit" value="Guardar"
                                       class="btn btn-primary"
                                       data-jida="validador">
                            </div>
                        </div>
                    </section>
                </form>
            </div>
        </div>
    </div>
</div>