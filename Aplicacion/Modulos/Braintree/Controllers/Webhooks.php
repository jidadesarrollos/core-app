<?php

namespace App\Modulos\Braintree\Controllers;

use App\Controllers\App;
use App\Modulos\Braintree\Modelos\Webhook;
use App\Modulos\Braintree\Modelos\Subscription;

class Webhooks extends App {

    function index() {

        $value1 = $this->post('bt_signature');
        $value2 = $this->post('bt_payload');

        $hook = new Webhook();
        $response = $hook->check($value1, $value2);

        $this->data([
            'value1' => $value1,
            'value2' => $value2,
            'response' => $response
        ]);
    }

    function lista() {

    }

}

