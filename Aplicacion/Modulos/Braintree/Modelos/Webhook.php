<?php

namespace App\Modulos\Braintree\Modelos;

use App\Config\Configuracion;
use Jida\BD\DataModel;

class Webhook extends DataModel {

    public static function check($bt_signature, $bt_payload)
    {

        //$gateway = new \Braintree_Gateway(Configuracion::BRAINTREE_CONFIG);

        /*$webhookNotification = $gateway->webhookNotification()->parse(
            $bt_signature, $bt_payload
        );*/

        return 'check OK' . $bt_signature . ' ' .  $bt_payload;
    }
}
