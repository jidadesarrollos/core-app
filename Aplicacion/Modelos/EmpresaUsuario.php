<?php

namespace App\Modelos;

use Jida\Core\Modelo;

class EmpresaUsuario extends Modelo {

    var $id_empresa_usuario;
    var $id_empresa;
    var $id_usuario;

    protected $tablaBD = 'r_empresas_usuarios';
    protected $pk = 'id_empresa_usuario';

    function obtArreglo($id_usuario) {

        $this->consulta(['id_empresa']);
        $this->filtro(['id_usuario' => $id_usuario]);
        $result = $this->obt();
        $arr = [];
        foreach ($result as $v) {
            $arr[] = $v['id_empresa'];
        }

        return $arr;

    }

    function obtArregloEmpresas($id_usuario) {

        $this->consulta(['id_empresa']);
        $this->join('m_empresas', ['empresa', 'identificador'],
            ['clave' => 'id_empresa', 'clave_relacion' => 'id_empresa']);
        $this->filtro(['id_usuario' => $id_usuario]);
        $this->order('m_empresas.empresa', 'asc');
        $result = $this->obt();
        $arr = [];
        foreach ($result as $k => $v) {
            $id = $v['id_empresa'];
            $arr[$id] = $v['empresa'];
        }

        return $arr;

    }

    public function obtEmpresas($idUsuario) {

        $this->consulta(['id_empresa_usuario', 'id_empresa', 'id_usuario']);
        $this->join('m_empresas', ['empresa', 'identificador'],
            ['clave' => 'id_empresa', 'clave_relacion' => 'id_empresa']);
        $this->join('s_usuarios', ['usuario'],
            ['clave' => 'id_usuario', 'clave_relacion' => 'id_usuario']);
        $this->filtro(['id_usuario' => $idUsuario]);

        $empresas = $this->obt();

        return $empresas;

    }

}