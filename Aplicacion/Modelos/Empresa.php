<?php

namespace App\Modelos;

use Jida\Core\Modelo;

class Empresa extends Modelo {

    public $id_empresa;
    public $empresa;
    public $identificador;

    protected $tablaBD = 'm_empresas';
    protected $pk = 'id_empresa';

}
