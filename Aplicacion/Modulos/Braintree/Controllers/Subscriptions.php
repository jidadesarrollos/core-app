<?php

namespace App\Modulos\Braintree\Controllers;

use App\Controllers\App;
use App\Modulos\Braintree\Modelos\Subscription;

class Subscriptions extends App {

    function index() {

    }

    function lista() {

    }

    function create(){
        $subscription = new Subscription();
        $params = [
            'payment_method_token'=> '966pkdb',
            'price'=> 10,
            'plan' => 'fcqm'
        ];
        $response = $subscription->save($params);

    }
}

