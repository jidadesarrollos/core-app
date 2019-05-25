<?php

namespace App\Modulos\Recursos\Modelos;

class Media extends \Jida\Core\Modelo {

    public $id_media_proyecto;
    public $nombre_archivo;
    public $titulo;
    public $directorio;
    public $tipo_media;
    public $descripcion;
    public $leyenda;
    public $meta_data;
    public $id_idioma;
    public $texto_original;

    protected $tablaBD = "t_media_proyectos";
    protected $pk = 'id_media_proyecto';

}