<?php

namespace App\Modulos\Braintree\Modelos;

class PaymentMethod extends Braintree {

    public $id_payment_method;
    public $customer_id;
    public $payment_method_nonce;
    public $creator_user_id;
    public $modifier_user_id;
    public $time_created;
    public $time_updated;

    protected $tablaBD = "bt_payment_methods";
    protected $pk = "id_payment_method";

    public function __construct() {
        parent::__construct();
    }

    public function createNonce($payment_method_token){

        $result = $this->gateway->paymentMethodNonce()->create($payment_method_token);
        return $result->paymentMethodNonce->nonce;
    }

}