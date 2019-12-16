<?php

namespace App\Modelos;

use Jida\Modulos\Usuarios\Modelos\Usuario;

class User extends Usuario {

    public $id_departamento;
    public $id_cargo;
    public $id_empresa;
    public $tipo_usuario;

    protected $_cargo;

    static private $instancia = null;

    function __construct($id = false) {
        parent::__construct($id);
        $this->_cargo = new Cargo($this->id_cargo);

    }

    public function cargo() {
        return $this->_cargo;
    }

    static function listadoUsuarios($consulta = []) {

        if (self::$instancia == null) {
            self::$instancia = new User();
        }

        if (empty($consulta)) {
            $consulta = ['id_usuario', 'usuario', 'nombres', 'apellidos', 'id_usuario as empresas', 'id_usuario as departamentos', 'id_cargo', 'id_estatus'];
        }
        else {
            $consulta[] = 'id_usuario as empresas';
        }

        $data = self::$instancia->consulta($consulta)->obt();

        $empresas = new EmpresaUsuario();

        foreach ($data as &$fila) {
            $fila['empresas'] = $empresas->obtEmpresas($fila['id_usuario']);
        }

        $departamentos = new DepartamentoUsuario();

        foreach ($data as &$fila) {
            $fila['departamentos'] = $departamentos->obtDepartamentos($fila['id_usuario']);
        }

        return $data;
    }

}
