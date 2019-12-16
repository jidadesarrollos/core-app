<?php

namespace App\Jadmin\Controllers;

use App\Modelos as Modelos;
use Jida\Medios\Mensajes;
use Jida\Medios\Sesion;
use JidaRender as Render;

class Departamentos extends Jadmin {

    private $_cargo;

    function __construct() {

        parent::__construct();
        $this->modelo = new Modelos\Departamento();
        $user = new Modelos\User(Sesion::$usuario->obtener('id_usuario'));
        $this->_cargo = strtolower($user->cargo()->identificador);

    }

    function index() {

        if (!in_array($this->_cargo, ['director', 'coordinador'])) {
            $this->redireccionar('/jadmin/actividades');
        }

        $data = $this->modelo
            ->consulta(['id_departamento', 'departamento', 'id_usuario'])
            ->obt();

        $parametros = ['titulos' => ['Departamento', 'Encargado']];

        $vista = new Render\JVista($data, $parametros);

        $vista->acciones(['Registrar Departamento' => ['href' => '/jadmin/departamentos/gestion/']]);

        $vista->accionesFila([

            [
                'span'  => 'fa fa-users',
                'title' => "Usuarios",
                'href'  => "/jadmin/departamentos/listadousuarios/{clave}"
            ],
            [
                'span'  => 'fa fa-edit',
                'title' => "Editar",
                'href'  => "/jadmin/departamentos/gestion/{clave}"
            ],
            [
                'span'       => 'fa fa-trash',
                'title'      => 'Eliminar',
                'href'       => "/jadmin/departamentos/eliminar/{clave}",
                'data-class' => 'eliminar'
            ]
        ]);

        $vista->addMensajeNoRegistros('No existen registros',
            ['link' => "/jadmin/departamentos/gestion/", 'txtLink' => 'Registrar Departamento']);

        $render = $vista->render(
            function ($datos) {

                foreach ($datos as $key => &$value) {
                    if (!empty($value['id_usuario'])) {
                        $usuario = new Modelos\User($value['id_usuario']);
                        $value['id_usuario'] = $usuario->nombres . " " . $usuario->apellidos;
                    }
                }

                return $datos;

            }
        );

        $this->data(['vista' => $render]);

    }

    function gestion($id = "") {

        if (!in_array($this->_cargo, ['director', 'coordinador'])) {
            $this->redireccionar('/jadmin/actividades');
        }

        $form = new Render\Formulario('GestionDepartamentos', $id);
        $modelo = new Modelos\Departamento($id);

        if ($this->post('btnGestionDepartamentos')) {

            if ($form->validar()) {

                if ($modelo->salvar($this->post())) {

                    if (empty($id)) {
                        $du = new Modelos\DepartamentoUsuario();
                        $du->id_departamento = $modelo->id_departamento;
                        $du->id_usuario = $modelo->id_usuario;
                        $du->salvar();
                    }

                    $accion = (empty($id)) ? 'guardado' : 'modificado';
                    $tipo = 'suceso';
                    $msj = 'Registro <strong>' . $accion . '</strong> exitosamente';
                    Mensajes::almacenar(Mensajes::suceso($msj));
                    $this->redireccionar("/jadmin/departamentos/");

                }

            }
            else {
                $form::msj('error', 'Los datos ingresados no son v&aacute;lidos');
            }

        }

        $this->data(['form' => $form->render()]);

    }

    function eliminar($id = '') {

        if (!in_array($this->_cargo, ['director', 'coordinador'])) {
            $this->redireccionar('/jadmin/actividades');
        }

        if (!empty($id)) {

            $modelo = new Modelos\Departamento($id);

            if (!empty($modelo->id_departamento) and $modelo->eliminar()) {
                Mensajes::almacenar(Mensajes::suceso('El registro ha sido eliminado correctamente'));
                $this->redireccionar("/jadmin/departamentos/");
            }
            else {
                Mensajes::almacenar(Mensajes::error('El registro que desea eliminar no existe'));
                $this->redireccionar("/jadmin/departamentos/");
            }

        }
        else {
            Mensajes::almacenar(Mensajes::error('El registro que desea eliminar no existe'));
            $this->redireccionar("/jadmin/departamentos/");
        }

    }

    function listadoUsuarios($id_departamento = "") {

        if (!in_array($this->_cargo, ['director', 'coordinador'])) {
            $this->redireccionar('/jadmin/actividades');
        }

        $departamento = new Modelos\Departamento($id_departamento);
        $rDeptUsuario = new Modelos\DepartamentoUsuario();

        $data = $rDeptUsuario->consulta(['id_departamento_usuario', 'id_usuario'])
            ->filtro(['id_departamento' => $id_departamento])
            ->obt();

        $parametros = ['titulos' => ['Nombre']];

        $vista = new Render\JVista($data, $parametros);

        $vista->accionesFila([
            [
                'span'       => 'fa fa-trash',
                'title'      => 'Eliminar',
                'href'       => "/jadmin/departamentos/eliminarusuario/{$id_departamento}/{clave}",
                'data-class' => 'eliminar',
                'data-msj'   => '<h3>¡Cuidado!</h3>&iquest;Realmente desea eliminar el registro seleccionado?'
            ]
        ]);

        $vista->acciones(['Regresar' => ['href' => "/jadmin/departamentos/"]]);
        $vista->acciones(['Agregar Usuario' => ['href' => "/jadmin/departamentos/agregarusuario/{$id_departamento}"]]);

        $vista->addMensajeNoRegistros('No existen registros',
            ['link'    => "/jadmin/departamentos/agregarusuario/{$id_departamento}",
             'txtLink' => 'Agregar Usuario']);

        $render = $vista->render(
            function ($datos) {

                foreach ($datos as $key => &$value) {
                    if (!empty($value['id_usuario'])) {
                        $usuario = new Modelos\User($value['id_usuario']);
                        $value['id_usuario'] = $usuario->nombres . " " . $usuario->apellidos;
                    }
                }

                return $datos;

            }
        );

        $this->data([
            'titulo' => $departamento->departamento . ': Listado de Usuarios',
            'vista'  => $render
        ]);

    }

    function agregarUsuario($id_departamento = "") {

        if (!in_array($this->_cargo, ['director', 'coordinador'])) {
            $this->redireccionar('/jadmin/actividades');
        }

        $mUsuario = new Modelos\User();
        $rDeptUsuario = new Modelos\DepartamentoUsuario();

        if ($this->post('id_usuario')) {

            $this->post('id_departamento', $id_departamento);

            if ($rDeptUsuario->salvar($this->post())) {

                $msj = 'Registro <strong>guardado</strong> exitosamente';
                Mensajes::almacenar(Mensajes::suceso($msj));
                $this->redireccionar("/jadmin/departamentos/listadousuarios/{$id_departamento}");

            }

        }

        $usuarios = $mUsuario->consulta(['id_usuario', 'nombres', 'apellidos'])
            ->obt();
        $miembros = $rDeptUsuario->consulta('id_usuario')
            ->filtro(['id_departamento' => $id_departamento])
            ->obt();

        $listaMiembros = [];
        foreach ($miembros as $miembro)
            $listaMiembros[] = $miembro['id_usuario'];

        $this->data(['usuarios' => $usuarios, 'departamento' => $id_departamento, 'miembros' => $listaMiembros]);

    }

    function eliminarUsuario($departamento, $id = '') {

        if (!in_array($this->_cargo, ['director', 'coordinador'])) {
            $this->redireccionar('/jadmin/actividades');
        }

        if (!empty($id)) {

            $modelo = new Modelos\DepartamentoUsuario($id);

            if (!empty($modelo->id_departamento_usuario) and $modelo->eliminar()) {
                Mensajes::almacenar(Mensajes::suceso('El registro ha sido eliminado correctamente'));
                $this->redireccionar("/jadmin/departamentos/listadousuarios/{$departamento}");
            }
            else {
                Mensajes::almacenar(Mensajes::error('El registro que desea eliminar no existe'));
                $this->redireccionar("/jadmin/departamentos/listadousuarios/{$departamento}");
            }

        }
        else {
            Mensajes::almacenar(Mensajes::error('El registro que desea eliminar no existe'));
            $this->redireccionar("/jadmin/departamentos/listadousuarios/{$departamento}");
        }

    }

}
