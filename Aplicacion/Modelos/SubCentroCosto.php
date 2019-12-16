<?php

namespace App\Modelos;

use Jida\Core\Modelo;
use Jida\Medios\Debug;

class SubCentroCosto extends Modelo {

    public $id_subcentro_costo;
    public $subcentro_costo;
    public $id_centro_costo;
    public $horas;
    public $id_estatus;

    protected $tablaBD = 'm_subcentros_costos';
    protected $pk = 'id_subcentro_costo';

    public function obtArreglo($arreglo = []) {

        $this->consulta(['id_subcentro_costo', 'subcentro_costo']);
        $this->in($arreglo, 'id_centro_costo');
        $this->filtro(['id_estatus' => 1]);
        $this->order('subcentro_costo', 'asc');
        $resultado = $this->obt();

        $arreglo = [];
        foreach ($resultado as $valor) {
            $arreglo[$valor['id_subcentro_costo']] = $valor['subcentro_costo'];
        }

        return $arreglo;

    }

}
