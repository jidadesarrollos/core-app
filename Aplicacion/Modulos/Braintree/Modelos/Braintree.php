<?php

namespace App\Modulos\Braintree\Modelos;

use App\Config\Configuracion;
use Jida\BD\DataModel;

class Braintree extends DataModel {

    public function token() {
        $gateway = new \Braintree_Gateway(Configuracion::BRAINTREE_CONFIG);
        return $gateway->clientToken()->generate();
    }

}
