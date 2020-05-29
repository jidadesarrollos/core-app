<div class="container">
    <h1 class="text-center">Agregar método de pago</h1>
    <form method="post" class="payment-form"
          action="<?= $this->urlBase . "/braintree/payment-methods/create/" . $this->idCustomer ?>">
        <div class="form-group col-md-12">
            <div class="dropin-container"></div>
            <input type="hidden" id="nonce" name="nonce">
        </div>
        <div class="form-group col-md-12 mt-3">
            <input type="submit" class="btn btn-primary" name="btnSubmit" value="Enviar"/>
        </div>
    </form>
</div>