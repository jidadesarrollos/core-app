<?php

namespace App\Modulos\Braintree\Modelos;

class PaymentMethod extends Braintree {

    public $id_payment_method;
    public $payment_method_nonce;
    public $id_customer;
    public $creator_user_id;
    public $modifier_user_id;
    public $time_created;
    public $time_updated;

    protected $tablaBD = "bt_payment_methods";
    protected $pk = "id_payment_method";

    public function __construct() {
        parent::__construct();
    }

    public function create($params) {
        return $this->gateway->paymentMethod()->create($params);
    }

    public function find($token) {
        return $this->gateway->paymentMethod()->find($token);
    }

    public function update($token, $params) {
        return $this->gateway->paymentMethod()->update($token, $params);
    }

    public function delete($token) {
        return $this->gateway->paymentMethod()->delete($token);
    }

}