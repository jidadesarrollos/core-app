<?php

namespace App\Modulos\Empresas\Jadmin\Controllers;

use App\Jadmin\Controllers\Jadmin;
use App\Modelos\User;
use App\Modulos\Empresas\Modelos\Empresa;
use Jida\Medios\Cadenas;
use Jida\Medios\Mensajes;
use Jida\Medios\Sesion;
use JidaRender as Render;

class Empresas extends Jadmin {

    private $_cargo;

    function __construct() {
        parent::__construct();
        $this->modelo = new Empresa();
        $user = new User(Sesion::$usuario->obtener('id_usuario'));
        $this->_cargo = strtolower($user->cargo()->identificador);
    }

    function index() {

        if (!in_array($this->_cargo, ['director', 'coordinador'])) {
            $this->redireccionar('/jadmin/actividades');
        }

        $data = $this->modelo
            ->consulta(['id_empresa', 'empresa', 'identificador'])
            ->obt();

        $parametros = ['titulos' => ['Empresa', 'Identificador']];
        $vista = new Render\JVista($data, $parametros);

        $vista->acciones(['Nueva Empresa' => ['href' => '/jadmin/empresas/gestion']]);
        $vista->accionesFila([
            ['span'  => 'fa fa-edit',
             'title' => "Editar Empresa",
             'href'  => '/jadmin/empresas/gestion/{clave}'],
            ['span'        => 'fa fa-trash',
             'title'       => 'Eliminar Empresa',
             'href'        => '/jadmin/empresas/eliminar/{clave}',
             'data-jvista' => 'confirm',
             'data-msj'    => '<h3>¡Cuidado!</h3>&iquest;Realmente desea eliminar la empresa seleccionada?']
        ]);
        $vista->addMensajeNoRegistros('No hay Empresas Registradas',
            ['link'    => '/jadmin/empresas/gestion/',
             'txtLink' => 'Registrar Empresa'
            ]);

        $render = $vista->render();

        $this->data([
            'vista' => $render
        ]);
    }

    function gestion($id = "") {

        if (!in_array($this->_cargo, ['director', 'coordinador'])) {
            $this->redireccionar('/jadmin/actividades');
        }

        $form = new Render\Formulario('Empresas/GestionEmpresas', $id);
        $modelo = new Empresa($id);

        if ($this->post('btnGestionEmpresas')) {

            if ($form->validar()) {

                $modelo->identificador = Cadenas::guionCase($this->post('empresa'));

                if ($modelo->salvar($this->post())) {
                    $accion = (empty($id)) ? 'registrada' : 'actualizada';
                    Mensajes::almacenar(Mensajes::suceso("Empresa {$accion} exitosamente."));
                    $this->redireccionar('/jadmin/empresas/');
                }
            }
            else {
                $form::msj('error', 'Los datos ingresados no son v&aacute;lidos');
            }
        }

        $this->data([
            'vista' => $form->render(),
        ]);
    }

    function eliminar($id = '') {

        if (!in_array($this->_cargo, ['director', 'coordinador'])) {
            $this->redireccionar('/jadmin/actividades');
        }

        if (!empty($id)) {
            $empresa = new Empresa($id);
            if (!empty($empresa->id_empresa) and $empresa->eliminar()) {
                Mensajes::almacenar(Mensajes::suceso("Empresa eliminada."));
                $this->redireccionar('/jadmin/empresas/');
            }
            else {
                Mensajes::almacenar(Mensajes::error("No se pudo eliminar la empresa."));
                $this->redireccionar('/jadmin/empresas/');
            }
        }
        else {
            Mensajes::almacenar(Mensajes::error("La empresa solicitada no existe."));
            $this->redireccionar('/jadmin/empresas/');
        }
    }

}
