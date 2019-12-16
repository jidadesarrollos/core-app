<?php

namespace App\Modelos;

use Jida\Core\Modelo;

class DepartamentoUsuario extends Modelo {

    var $id_departamento_usuario;
    var $id_departamento;
    var $id_usuario;

    protected $tablaBD = 'r_departamentos_usuarios';
    protected $pk = 'id_departamento_usuario';

    function obtIdsUsuariosPorDepartamento($id_departamento) {

        $this->consulta(['id_usuario']);
        $this->filtro(['id_departamento' => $id_departamento]);
        $result = $this->obt();
        $arr = [];
        foreach ($result as $v) {
            $arr[] = $v['id_usuario'];
        }

        return $arr;

    }

    public function obtDepartamentos($idUsuario) {

        $this->consulta(['id_departamento_usuario', 'id_departamento', 'id_usuario']);
        $this->join('m_departamentos', ['departamento'],
            ['clave' => 'id_departamento', 'clave_relacion' => 'id_departamento']);
        $this->join('s_usuarios', ['usuario'],
            ['clave' => 'id_usuario', 'clave_relacion' => 'id_usuario']);
        $this->filtro(['id_usuario' => $idUsuario]);
        $this->order('s_usuarios.usuario', 'asc');

        $departamentos = $this->obt();

        return $departamentos;

    }

}
