<?php

namespace App\Jadmin\Controllers;

use App\Modelos as Modelos;
use Jida\Medios\Cadenas;
use Jida\Medios\Mensajes;
use Jida\Medios\Sesion;
use JidaRender as Render;

class Cargos extends Jadmin {

    private $_cargo;

    function __construct() {

        parent::__construct();
        $this->modelo = new Modelos\Cargo();
        $user = new Modelos\User(Sesion::$usuario->obtener('id_usuario'));
        $this->_cargo = strtolower($user->cargo()->identificador);

    }

    function index() {

        if (!in_array($this->_cargo, ['director', 'coordinador'])) {
            $this->redireccionar('/jadmin/actividades');
        }

        $data = $this->modelo
            ->consulta(['id_cargo', 'cargo', 'identificador'])
            ->obt();

        $parametros = ['titulos' => ['Cargo', 'Identificador']];

        $vista = new Render\JVista($data, $parametros);

        $vista->acciones(['Registrar Cargo' => ['href' => "/jadmin/cargos/gestion"]]);

        $vista->accionesFila([
            [
                'span'  => 'fa fa-edit',
                'title' => "Editar",
                'href'  => "/jadmin/cargos/gestion/{clave}"
            ],
            [
                'span'       => 'fa fa-trash',
                'title'      => 'Eliminar',
                'href'       => "/jadmin/cargos/eliminar/{clave}",
                'data-class' => 'eliminar'

            ]
        ]);

        $vista->addMensajeNoRegistros('No existen registros',
            ['link' => "/jadmin/cargos/gestion/", 'txtLink' => 'Registrar Cargo']);

        $this->data(['vista' => $vista->render()]);

    }

    function gestion($id = "") {

        if (!in_array($this->_cargo, ['director', 'coordinador'])) {
            $this->redireccionar('/jadmin/actividades');
        }

        $form = new Render\Formulario('GestionCargos', $id);
        $modelo = new Modelos\Cargo($id);

        if ($this->post('btnGestionCargos')) {

            if ($form->validar()) {

                $modelo->identificador = Cadenas::guionCase($this->post('cargo'));

                if ($modelo->salvar($this->post())) {

                    $accion = (empty($id)) ? 'guardado' : 'modificado';
                    $tipo = 'suceso';
                    $msj = 'Registro <strong>' . $accion . '</strong> exitosamente';
                    Mensajes::almacenar(Mensajes::suceso($msj));
                    $this->redireccionar("/jadmin/cargos/");

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

            $modelo = new Modelos\Cargo($id);

            if (!empty($modelo->id_cargo) and $modelo->eliminar()) {
                Mensajes::almacenar(Mensajes::suceso('El registro ha sido eliminado correctamente'));
                $this->redireccionar("/jadmin/cargos/");
            }
            else {
                Mensajes::almacenar(Mensajes::error('El registro que desea eliminar no existe'));
                $this->redireccionar("/jadmin/cargos/");
            }

        }
        else {
            Mensajes::almacenar(Mensajes::error('El registro que desea eliminar no existe'));
            $this->redireccionar("/jadmin/cargos/");
        }

    }

}
