<?php

namespace App\Modulos\Braintree\Modelos;

use App\Config\Configuracion;
use Jida\BD\DataModel;

class Braintree extends DataModel {

    public $gateway;

    public function __construct() {
        parent::__construct();
        $this->gateway = new \Braintree_Gateway(Configuracion::BRAINTREE_CONFIG);
    }

    public function token() {
        return $this->gateway->clientToken()->generate();
    }

    public function customer() {
        return new Customer($this);
    }

    public function paymentMethod() {
        return new PaymentMethod($this);
    }

    public function subscription() {
        return new Subscription($this);
    }

    public function transaction() {
        return new Transaction($this);
    }

}
