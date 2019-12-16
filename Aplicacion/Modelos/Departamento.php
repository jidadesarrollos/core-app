<?php

namespace App\Modelos;

use Jida\Core\Modelo;

class Departamento extends Modelo {

    var $id_departamento;
    var $departamento;
    var $id_usuario;

    protected $tablaBD = 'm_departamentos';
    protected $pk = 'id_departamento';

}
