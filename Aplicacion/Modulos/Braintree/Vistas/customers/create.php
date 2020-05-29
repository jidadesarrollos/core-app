<div class="container">
    <h1 class="text-center">Agregar cliente</h1>
    <form method="post" class="payment-form">
        <div class="form-group col-md-6">
            <label>Nombre</label>
            <input type="text" class="form-control" name="first_name" placeholder="Nombre" required>
        </div>
        <div class="form-group col-md-6">
            <label>Apellido</label>
            <input type="text" class="form-control" name="last_name" placeholder="Apellido" required>
        </div>
        <div class="form-group col-md-6">
            <label>Empresa</label>
            <input type="text" class="form-control" name="company" placeholder="Empresa" required>
        </div>
        <div class="form-group col-md-6">
            <label>Email</label>
            <input type="email" class="form-control" name="email" placeholder="Email" required>
        </div>
        <div class="form-group col-md-6">
            <label>Telefono</label>
            <input type="tel" class="form-control" name="phone" placeholder="Telefono" required>
        </div>
        <div class="form-group col-md-6">
            <label>Fax</label>
            <input type="tel" class="form-control" name="fax" placeholder="Fax" required>
        </div>
        <div class="form-group col-md-6">
            <label>Sitio Web</label>
            <input type="text" class="form-control" name="website" placeholder="Sitio Web" required>
        </div>
        <div class="form-group col-md-12 mt-3">
            <input type="submit" class="btn btn-primary" name="btnSubmit" value="Enviar"/>
        </div>
    </form>
</div>