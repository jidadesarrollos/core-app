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
            'plan_id' => 'fcqm',
            'id_usuario' => 2
        ];
        $subscription->save($params);

    }

    function update(){
        $subscription = new Subscription();
        $params = [
            'id'=> 'hhk97b',
            'status'=> 'Canceled'
        ];
        $subscription->changeStatus($params);
    }

}

