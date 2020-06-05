<?php

namespace App\Modulos\Braintree\Modelos;

use App\Config\Configuracion;
use Jida\BD\DataModel;

class Webhook extends DataModel {

    public static function parse($bt_signature, $bt_payload) {

        $gateway = new \Braintree\Gateway(Configuracion::BRAINTREE_CONFIG);

        return $gateway->webhookNotification()->parse(
            $bt_signature, $bt_payload
        );

    }
}
