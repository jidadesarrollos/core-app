<?php

namespace App\Modulos\Gateway\Modelos;

class Suscripcion extends Gateway {

    public function __construct() {
        parent::__construct();
    }

    public function crear($params) {
        return $this->gateway->subscription()->create($params);
    }

    public function buscar($id) {
        return $this->gateway->subscription()->find($id);
    }

    public function editar($id, $params) {
        return $this->gateway->subscription()->update($id, $params);
    }

    public function cancelar($id) {
        return $this->gateway->subscription()->cancel($id);
    }

}