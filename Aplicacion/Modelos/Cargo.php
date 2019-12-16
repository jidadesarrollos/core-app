<?php

namespace App\Modelos;

use Jida\Core\Modelo;

class Cargo extends Modelo {

    var $id_cargo;
    var $cargo;
    var $identificador;

    protected $tablaBD = 'm_cargos';
    protected $pk = 'id_cargo';

}
