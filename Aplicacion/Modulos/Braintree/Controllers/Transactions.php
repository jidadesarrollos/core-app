<?php

namespace App\Modulos\Braintree\Controllers;

use App\Controllers\App;
use App\Modulos\Braintree\Modelos\PaymentMethod;
use App\Modulos\Braintree\Modelos\Transaction;
use Jida\Medios\Debug;

class Transactions extends App {

    function index() {

    }

    function lista() {

    }

    function create(){
        $payment_method = new PaymentMethod();
        $client_nonce = $payment_method->createNonce('966pkdb');
        $transaction = new Transaction();
        $params = [
            'payment_method_nonce'=> $client_nonce,
            'amount'=> 10
        ];
        $payment = $transaction->create($params);

    }

}

