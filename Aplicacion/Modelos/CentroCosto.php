<?php

namespace App\Modelos;

use Jida\Core\Modelo;
use Jida\Medios\Debug;

class CentroCosto extends Modelo {

    public $id_centro_costo;
    public $centro_costo;
    public $id_empresa;
    public $horas;
    public $id_estatus;

    protected $_empresa;

    protected $tablaBD = 'm_centros_costos';
    protected $pk = 'id_centro_costo';

    function __construct($id = false) {
        parent::__construct($id);
        $this->_empresa = new Empresa($this->id_empresa);

    }

    public function empresa() {
        return $this->_empresa;
    }

    public function obtArreglo($arreglo = []) {

        $this->consulta(['id_centro_costo', 'centro_costo']);
        $this->in($arreglo, 'id_empresa');
        $this->filtro(['id_estatus' => 1]);
        $this->order('centro_costo', 'asc');
        $resultado = $this->obt();

        $arreglo = [];
        foreach ($resultado as $k => $valor) {
            $id = $valor['id_centro_costo'];
            $arreglo[$id] = $valor['centro_costo'];
        }

        return $arreglo;

    }

}
