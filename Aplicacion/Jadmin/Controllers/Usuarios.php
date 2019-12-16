<?php

namespace App\Jadmin\Controllers;

use App\Modelos as Modelos;
use App\Modulos\Empresas\Modelos\Empresa;
use Jida\Manager\Estructura;
use Jida\Medios\Mensajes;
use Jida\Medios\Sesion;
use JidaRender as Render;

class Usuarios extends Jadmin {

    private $_cargo;

    function __construct() {

        parent::__construct();
        $this->modelo = new Modelos\User();
        $user = new Modelos\User(Sesion::$usuario->obtener('id_usuario'));
        $this->_cargo = strtolower($user->cargo()->identificador);

    }

    function index() {

        if (!in_array($this->_cargo, ['director', 'coordinador'])) {
            $this->redireccionar('/jadmin/actividades');
        }

        $data = $this->modelo
            ->consulta(['id_usuario', 'usuario', 'nombres', 'apellidos', 'id_empresa', 'id_departamento', 'id_cargo', 'id_estatus'])
            ->obt();

        $data = Modelos\User::listadoUsuarios();

        $parametros = ['titulos' => ['Usuario', 'Nombres', 'Apellidos', 'Empresas', 'Departamento', 'Cargo', 'Estatus']];

        $vista = new Render\JVista($data, $parametros);

        $vista->acciones(['Registrar Usuario' => ['href' => '/jadmin/usuarios/gestion']]);

        $vista->accionesFila([
            [
                'span'  => 'fa fa-edit',
                'title' => "Editar",
                'href'  => "/jadmin/usuarios/gestion/{clave}"
            ],
            [
                'span'  => 'fas fa-building',
                'title' => 'Empresas',
                'href'  => '/jadmin/usuarios/empresas/{clave}'
            ],
            [
                'span'       => 'fa fa-trash',
                'title'      => 'Eliminar',
                'href'       => "/jadmin/usuarios/eliminar/{clave}",
                'data-class' => 'eliminar',
                'data-msj'   => '<h3>¡Cuidado!</h3>&iquest;Realmente desea eliminar el registro seleccionado?'
            ]
        ]);

        $vista->addMensajeNoRegistros('No existen registros',
            ['link' => "/jadmin/usuarios/gestion/", 'txtLink' => 'Registrar Usuario']);

        $render = $vista->render(
            function ($datos) {

                foreach ($datos as $key => &$value) {
                    if (!empty($value['id_empresa'])) {
                        $empresa = new Modelos\Empresa($value['id_empresa']);
                        $value['id_empresa'] = $empresa->empresa;
                    }
                    if (!empty($value['id_departamento'])) {
                        $departamento = new Modelos\Departamento($value['id_departamento']);
                        $value['id_departamento'] = $departamento->departamento;
                    }
                    if (!empty($value['id_cargo'])) {
                        $cargo = new Modelos\Cargo($value['id_cargo']);
                        $value['id_cargo'] = $cargo->cargo;
                    }

                    $listadoEmpresas = '<ul>';
                    foreach ($value['empresas'] as $empresa) {
                        $listadoEmpresas .= "<li>{$empresa['empresa']}</li>";
                    }
                    $listadoEmpresas .= '</ul>';
                    $value['empresas'] = $listadoEmpresas;

                    $listadoDepartamentos = '<ul>';
                    foreach ($value['departamentos'] as $departamento) {
                        $listadoDepartamentos .= "<li>{$departamento['departamento']}</li>";
                    }
                    $listadoDepartamentos .= '</ul>';
                    $value['departamentos'] = $listadoDepartamentos;
                    $value['id_estatus'] = $value['id_estatus'] == 1 ? 'Activo' : 'Inactivo';

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

        if (!$this->solicitudAjax()) {
            $this->layout()->incluirJS([Estructura::$urlBase . '/Aplicacion/Jadmin/htdocs/js/formUsuarios.js']);
            $this->layout('jadmin');
        }
        else {
            $this->layout()->incluirJSAjax([Estructura::$urlBase . '/Aplicacion/Jadmin/htdocs/js/formUsuarios.js']);
            $this->layout('ajax');
        }

        $form = new Render\Formulario('GestionUsuarios', $id);
        $modelo = new Modelos\User($id);

        if ($this->post('btnGestionUsuarios')) {

            if ($form->validar()) {

                if (!$modelo->id_usuario) {
                    $modelo->activo = 1;
                    $modelo->id_estatus = 1;
                    $modelo->validacion = 1;
                }

                empty($this->post('clave')) ? $this->post('clave', '123456') : null;

                if ($this->post('clave') != $modelo->clave) {
                    $this->post('clave', md5($this->post('clave')));
                }

                if ($modelo->salvar($this->post())) {

                    if (empty($id)) {
                        $usuarioPerfil = new Modelos\UsuarioPerfil($id);
                        $usuarioPerfil->salvar([
                            'id_usuario' => $modelo->id_usuario,
                            'id_perfil'  => 1 // Jida Admin
                        ]);
                        $usuarioEmpresa = new Modelos\EmpresaUsuario();
                        $usuarioEmpresa->salvar([
                            'id_usuario' => $modelo->id_usuario,
                            'id_empresa' => $modelo->id_empresa
                        ]);
                    }

                    $accion = (empty($id)) ? 'guardado' : 'modificado';
                    $tipo = 'suceso';
                    $msj = 'Registro <strong>' . $accion . '</strong> exitosamente';
                    Mensajes::almacenar(Mensajes::suceso($msj));
                    $this->redireccionar('/jadmin/usuarios/');

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

            $modelo = new Modelos\User($id);

            if (!empty($modelo->id_usuario) and $modelo->eliminar()) {
                Mensajes::almacenar(Mensajes::suceso('El registro ha sido eliminado correctamente'));
                $this->redireccionar('/jadmin/usuarios/');
            }
            else {
                Mensajes::almacenar(Mensajes::error('El registro que desea eliminar no existe'));
                $this->redireccionar('/jadmin/usuarios/');
            }

        }
        else {
            Mensajes::almacenar(Mensajes::error('El registro que desea eliminar no existe'));
            $this->redireccionar('/jadmin/usuarios/');
        }

    }

    public function empresas($id_usuario = "") {

        if (empty($id_usuario)) {
            $id_usuario = Sesion::$usuario->obtener('id_usuario');
        }

        if (!in_array($this->_cargo, ['director', 'coordinador'])) {
            $this->redireccionar('/jadmin/actividades');
        }

        $usuarioEmpresas = new Modelos\EmpresaUsuario();
        $usuarioEmpresas2 = $usuarioEmpresas
            ->consulta(['id_empresa_usuario', 'id_empresa'])
            ->filtro(['id_usuario' => $id_usuario])
            ->obt();
        $listadoEmpresas = [];
        foreach ($usuarioEmpresas2 as $fila) {
            $listadoEmpresas[] = $fila['id_empresa'];
        }
        $empresa = new Empresa();
        $empresa = $empresa->consulta()->obt();
        $usuario = new Modelos\User($id_usuario);

        if ($this->post('btnGestionEmpresas')) {
            foreach ($usuarioEmpresas2 as $fila) {
                $usuarioEmpresas->eliminar($fila['id_empresa_usuario']);
            }

            $nuevasEmpresas = [];
            foreach ($this->post('id_empresa') as $list) {
                $nuevasEmpresas[] = ['id_empresa' => $list, 'id_usuario' => $id_usuario];
            }
            $usuarioEmpresas->salvarTodo($nuevasEmpresas);
            Mensajes::almacenar(Mensajes::suceso('Empresas modificadas con éxito'));
            $this->redireccionar('/jadmin/usuarios');

        }

        $this->data([
            'listadoEmpresas' => $listadoEmpresas,
            'empresas'        => $empresa,
            'id_usuario'      => $id_usuario,
            'nombre'          => "{$usuario->nombres} {$usuario->apellidos}"
        ]);
    }

}
