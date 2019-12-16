<?php

namespace App\Modelos;

use Jida\Core\Modelo;

class Prioridad extends Modelo {

    public $id_prioridad;
    public $prioridad;

    protected $tablaBD = 'm_prioridades';
    protected $pk = 'id_prioridad';

    public function obtListado() {

        $result = $this->consulta('id_prioridad, prioridad')->obt();
        return $result;

    }

}
