<?php

namespace App\Jadmin\Controllers;

use App\Modelos as Modelos;
use Jida\Manager\Estructura;
use Jida\Medios\Mensajes;
use Jida\Medios\Sesion;
use JidaRender as Render;

class CentrosCostos extends Jadmin {

    private $_cargo;

    public function __construct() {

        parent::__construct();
        $this->modelo = new Modelos\CentroCosto();
        $user = new Modelos\User(Sesion::$usuario->obtener('id_usuario'));
        $this->_cargo = strtolower($user->cargo()->identificador);

    }

    public function index($id = "") {

        if (!in_array($this->_cargo, ['director', 'coordinador'])) {
            $this->redireccionar('/jadmin/actividades');
        }

        if (!$this->solicitudAjax()) {
            $this->layout()->incluirJS([
                Estructura::$urlBase . '/htdocs/js/tablecentroscostos.js'
            ]);
            $this->layout('jadmin');
        }
        else {
            $this->layout()->incluirJSAjax([
                Estructura::$urlBase . '/htdocs/js/tablecentroscostos.js'
            ]);
            $this->layout('ajax');
        }

    }

    public function gestion($id = "") {

        if (!in_array($this->_cargo, ['director', 'coordinador'])) {
            $this->redireccionar('/jadmin/actividades');
        }

        $form = new Render\Formulario('GestionCentrosCostos', $id);

        $modelo = new Modelos\CentroCosto($id);

        if ($this->post('btnGestionCentrosCostos')) {

            if ($form->validar()) {

                if ($modelo->salvar($this->post())) {

                    $accion = (empty($id)) ? 'guardado' : 'modificado';
                    $tipo = 'suceso';
                    $msj = 'Registro <strong>' . $accion . '</strong> exitosamente';
                    Mensajes::almacenar(Mensajes::suceso($msj));
                    $this->redireccionar('/jadmin/centros-costos/');

                }

            }
            else {
                $form::msj('error', 'Los datos ingresados no son v&aacute;lidos');
            }

        }

        $this->data(['form' => $form->render()]);

    }

    public function eliminar($id = '') {

        if (!in_array($this->_cargo, ['director', 'coordinador'])) {
            $this->redireccionar('/jadmin/actividades');
        }

        if (!empty($id)) {

            $modelo = new Modelos\CentroCosto($id);

            if (!empty($modelo->id_centro_costo) and $modelo->eliminar()) {
                Mensajes::almacenar(Mensajes::suceso('El registro ha sido eliminado correctamente'));
                $this->redireccionar('/jadmin/centros-costos/');
            }
            else {
                Mensajes::almacenar(Mensajes::error('El registro que desea eliminar no existe'));
                $this->redireccionar('/jadmin/centros-costos/');
            }

        }
        else {
            Mensajes::almacenar(Mensajes::error('El registro que desea eliminar no existe'));
            $this->redireccionar('/jadmin/centros-costos/');
        }

    }

    public function centro($idEmpresa = "") {

        $this->layout('ajax');

        if (empty($idEmpresa)) {
            return false;
        }

        $modelo = new Modelos\CentroCosto();
        $data = $modelo->consulta(['id_centro_costo', 'centro_costo'])
            ->filtro(['id_empresa' => $idEmpresa, 'id_estatus' => 1])
            ->order('centro_costo', 'asc')
            ->obt();
        $this->respuestaJson($data);

    }

    public function subcentro($idCentroCosto = "") {

        $this->layout('ajax');

        if (empty($idCentroCosto)) {
            return false;
        }

        $modelo = new Modelos\SubCentroCosto();
        $data = $modelo->consulta(['id_subcentro_costo', 'subcentro_costo'])
            ->filtro(['id_centro_costo' => $idCentroCosto, 'id_estatus' => 1])
            ->order('subcentro_costo', 'asc')
            ->obt();
        $this->respuestaJson($data);

    }

    public function protodata() {

        $modelo = new Modelos\CentroCosto();
        $centroscostos = $modelo->consulta()->obt();

        $data = ['data' => $centroscostos];

        $this->respuestaJson($data);

    }

}
