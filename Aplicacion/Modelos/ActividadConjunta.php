<?php

namespace App\Modelos;

use Jida\Core\Modelo;

class ActividadConjunta extends Modelo{

    var $id_actividad_usuario;
    var $id_actividad;
    var $id_usuario;

    protected $tablaBD = 'r_actividades_usuarios';
    protected $pk      = 'id_actividad_usuario';
}