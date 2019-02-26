<!-- Creado por Jida Framework  2019-02-26 20:42:24 -->
<div class = "jumbotron">
    <h2><?= $this->mensaje ?></h2>
    <p>Use esta plantilla para iniciar de forma rápida el desarrollo de un sitio web.  <pre><?= var_export($this->datos, true) ?></pre></p>
<form class="form form-control" >
    <div class="form-group">
        <label for="ejemplo_email_1">Email</label>
        <input type="email" class="form-control" id="ejemplo_email_1"
               placeholder="Introduce tu email">
    </div>

    <div class="form-group">
        <label for="ejemplo_archivo_1">Adjuntar un archivo</label>
        <input type="file" id="ejemplo_archivo_1">
        <p class="help-block">Ejemplo de texto de ayuda.</p>
    </div> 
    <div class="checkbox">
        <label>
            <input type="checkbox"> Activa esta casilla
        </label>
    </div>
    <button type="submit" class="btn btn-default">Enviar</button>
</form>

</div >