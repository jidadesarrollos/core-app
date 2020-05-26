<?php

namespace App\Modulos\Gateway\Modelos;

class Cliente extends Gateway {

    public function __construct() {
        parent::__construct();
    }

    public function crear($params) {
        return $this->gateway->customer()->create($params);
    }

}