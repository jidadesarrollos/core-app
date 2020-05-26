<?php

namespace App\Modulos\Gateway\Modelos;

class Suscripcion extends Gateway {

    public function __construct() {
        parent::__construct();
    }

    public function crear($params) {
        return $this->gateway->subscription()->create($params);
    }

    public function editar($idSuscripcion, $params) {
        return $this->gateway->subscription()->update($idSuscripcion, $params);
    }

    public function cancelar($idSuscripcion) {
        return $this->gateway->subscription()->cancel($idSuscripcion);
    }

}