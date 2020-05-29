<div class="container">
    <h1 class="text-center">Agregar suscripción</h1>
    <form method="post" class="subscription-form"
          action="<?= $this->urlBase . "/braintree/subscriptions/create/" . $this->idCustomer ?>">
        <div class="form-group col-md-12">
            <label>Plan</label>
            <select name="plan_id">
                <option>Selecciona un plan...</option>
                <option value="plan_mensual">Plan Mensual</option>
                <option value="plan_anual">Plan Anual</option>
            </select>
            <input type="hidden" name="payment_method_token" value=""/>
        </div>
        <div class="form-group col-md-12 mt-3">
            <input type="submit" class="btn btn-primary" name="btnSubmit" value="Enviar"/>
        </div>
    </form>
</div>