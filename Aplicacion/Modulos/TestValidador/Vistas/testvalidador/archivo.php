<!-- Creado por Jida Framework  2019-02-26 20:42:24 -->
<div class = "jumbotron">
    <h2><?= $this->mensaje ?></h2>
    <p>Use esta plantilla para iniciar de forma rápida el desarrollo de un sitio web.  </p>

    Email: <?= $this->datos->valido()?$this->datos['email']:'' ?><br>
    Archivo: <?= $this->datos->valido()?$this->datos['file']->getFilename():'' ?>
    <!--<pre><?= var_export($this->datos, true) ?></pre>-->
    <form class="form " target="" method="post"enctype="multipart/form-data">
        <div class="form-group">
            <label for="ejemplo_email_1">Email</label>
            <input type="email" name="email" class="form-control" id="ejemplo_email_1"
                   placeholder="Introduce tu email">
            <p class="help-block"><?= $this->datos->ultimoError('email') ?></p>
        </div>
        <div class="form-group">
            <label for="ejemplo_archivo_1">Adjuntar un archivo</label>
            <input type="file" name="file">
            <p class="help-block"><?= $this->datos->ultimoError('file') ?></p>
        </div> 
        <div class="checkbox">
            <label>
                <input type="checkbox"> Activa esta casilla
            </label>
        </div>
        <button type="submit" class="btn btn-default">Enviar</button>
    </form>

</div >