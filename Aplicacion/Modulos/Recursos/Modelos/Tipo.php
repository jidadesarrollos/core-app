<?php
/**
 * Created by PhpStorm.
 * User: Isaac
 * Date: 23/5/2019
 * Time: 02:04
 */

namespace App\Modulos\Recursos\Modelos;

class Tipo extends \Jida\Core\Modelo {

    var $id_tipo_recurso;
    var $tipo_recurso;
    var $identificador;

    protected $tablaBD = 'm_tipos_recursos';
    protected $pk = 'id_recurso_humano';

}