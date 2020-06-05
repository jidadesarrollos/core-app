<?php

namespace App\Modulos\Braintree\Modelos;

use App\Config\Configuracion;
use Jida\BD\DataModel;
use Jida\Medios\Debug;

class Webhook extends DataModel {

    public static function check($bt_signature, $bt_payload) {

        $gateway = new \Braintree_Gateway(Configuracion::BRAINTREE_CONFIG);

        Debug::imprimir(['$gateway', $gateway], true);

        /*$webhookNotification = $gateway->webhookNotification()->parse(
            $bt_signature, $bt_payload
        );*/

        return 'check OK' . $bt_signature . ' ' . $bt_payload;
    }
}
