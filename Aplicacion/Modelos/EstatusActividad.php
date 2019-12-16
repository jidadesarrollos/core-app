<?php

namespace App\Modelos;

use Jida\Core\Modelo;

class EstatusActividad extends Modelo {

    public $id_estatus_actividad;
    public $descripcion;

    protected $tablaBD = 'm_estatus_actividades';
    protected $pk = 'id_estatus_actividad';

}
