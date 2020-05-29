<?php

namespace App\Modulos\Braintree\Controllers;

use App\Controllers\App;
use App\Modulos\Braintree\Modelos\Braintree as Gateway;

class Braintree extends App {

    public $gateway;

    public function __construct() {
        parent::__construct();
        $this->gateway = new Gateway();
    }

    public function index() {

    }

    public function token() {

        $this->respuestaJson($this->gateway->token());

    }

}