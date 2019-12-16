<?php

namespace App\Modelos;

use Jida\Core\Modelo;

class ComentarioActividad extends Modelo {

    public $id_comentario_actividad;
    public $comentario;
    public $id_actividad;

    protected $tablaBD = 'r_comentarios_actividades';
    protected $pk = 'id_comentario_actividad';

}
