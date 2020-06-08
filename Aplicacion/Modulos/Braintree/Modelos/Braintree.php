<?php

namespace App\Modulos\Braintree\Modelos;

use App\Config\Configuracion;
use Jida\BD\DataModel;

class Braintree extends DataModel {

    protected $gateway;

    public function __construct() {
        parent::__construct();
        $this->gateway = new \Braintree\Gateway(Configuracion::BRAINTREE_CONFIG);
    }

    public function token() {
        return $this->gateway->clientToken()->generate();
    }

}
