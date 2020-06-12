<?php

namespace App\Modulos\Braintree\Modelos;

class PaymentMethod extends Braintree {

    public $id_payment_method;
    public $customer_id;
    public $payment_method_nonce;
    public $payment_method_token;

    protected $tablaBD = "bt_payment_methods";
    protected $pk = "id_payment_method";

    public function __construct() {
        parent::__construct();
    }

    public function createNonce($payment_method_token){
        $result = $this->gateway->paymentMethodNonce()->create($payment_method_token);
        return $result->paymentMethodNonce->nonce;
    }

    public function save($params, $id = "") {

        $this->instanciar($id);

        $data = [
            'paymentMethodNonce' => isset($params['payment_method_nonce']) ? $params['payment_method_nonce'] : "",

        ];

        if (isset($this->payment_method_token) and !empty($this->payment_method_token)) {
            $this->gateway->paymentMethod()->update($this->payment_method_token, $data);
        }
        else {
            $result = $this->gateway->paymentMethod()->create($data);
            if ($result->success) {
                /*$_customer = new Customer();
                $customer = $_customer->get($params['id_usuario'], true);
                $this->customer_id = $customer[0]['id_customer'];*/
            }
        }

        return $this->salvar($params);

    }

    public function delete($id) {

        $this->instanciar($id);
        $result = false;

        if (isset($this->id_payment_method)) {
            if (isset($this->payment_method_token) and !empty($this->payment_method_token)) {
                $this->gateway->paymentMethod()->delete($this->payment_method_token);
            }
            $result = $this->eliminar();
        }

        return $result;

    }

}