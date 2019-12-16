<?php

namespace App\Modulos\Empresas\Modelos;

use Jida\BD\DataModel;

class Empresa extends DataModel {

    var $id_empresa;
    var $empresa;
    var $identificador;

    protected $tablaBD = 'm_empresas';
    protected $pk = 'id_empresa';

}
