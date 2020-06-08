<?php

namespace App\Modulos\Braintree\Modelos;

class Webhook extends Braintree {

    public function parse($bt_signature, $bt_payload) {

        return $this->gateway->webhookNotification()->parse(
            $bt_signature, $bt_payload
        );

    }
}
