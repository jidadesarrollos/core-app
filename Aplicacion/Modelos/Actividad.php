<?php

namespace App\Modelos;

use Jida\Core\Modelo;
use Jida\Medios\Debug;

class Actividad extends Modelo {

    public $id_actividad;
    public $id_empresa;
    public $id_centro_costo;
    public $id_subcentro_costo;
    public $id_usuario;
    public $actividad;
    public $fecha_inicio;
    public $fecha_entrega;
    public $horas;
    public $descripcion;
    public $id_prioridad;
    public $id_estatus;

    protected $tablaBD = 't_actividades';
    protected $pk = 'id_actividad';

    function actividadesUsuario($idUsuario) {

        $this->consulta('id_actividad, fecha_inicio, fecha_entrega, t_actividades.horas, descripcion');
        $this->join('m_centros_costos', ['centro_costo'],
            ['clave' => 'id_centro_costo', 'clave_relacion' => 'id_centro_costo']);
        $this->order('id_actividad', 'desc');
        $this->limit(5);
        $this->filtro(['id_usuario' => $idUsuario]);

        $actividadesUsuario = $this->obt();

        return $actividadesUsuario;
    }

    function obtActividadesBandeja($idUsuario) {

        $this->consulta('id_actividad, actividad, t_actividades.descripcion, 
        t_actividades.id_estatus, fecha_inicio, fecha_entrega');
        $this->join('m_centros_costos', ['centro_costo'],
            ['clave' => 'id_centro_costo', 'clave_relacion' => 'id_centro_costo'], 'left');
        $this->join('m_subcentros_costos', ['subcentro_costo'],
            ['clave' => 'id_subcentro_costo', 'clave_relacion' => 'id_subcentro_costo'], 'left');
        $this->join('s_usuarios', ['id_usuario', 'nombres', 'apellidos'],
            ['clave' => 'id_usuario', 'clave_relacion' => 'id_usuario']);
        $this->join('m_prioridades', ['id_prioridad', 'prioridad'],
            ['clave' => 'id_prioridad', 'clave_relacion' => 'id_prioridad']);
        $this->join('m_estatus_actividades', ['id_estatus_actividad', 'descripcion as estatus_actividad'],
            ['clave' => 'id_estatus_actividad', 'clave_relacion' => 'id_estatus']);
        $this->order('id_actividad', 'desc');
        $this->in([1, 2, 3], 'id_estatus');
        $this->filtro(['id_usuario' => $idUsuario]);

        return $this->obt();

    }

}
