<?php

namespace App\Modulos\Gateway\Modelos;

use App\Config\Configuracion;
use Jida\Core\Modelo;

class Gateway extends Modelo {

    public $gateway;

    public function __construct() {
        parent::__construct();
        $this->gateway = new \Braintree_Gateway(Configuracion::BRAINTREE_CONFIG);
    }

    public function token() {
        return $this->gateway->clientToken()->generate();
    }

    public function cliente() {
        return new Cliente($this);
    }

    public function suscripcion() {
        return new Suscripcion($this);
    }

}
