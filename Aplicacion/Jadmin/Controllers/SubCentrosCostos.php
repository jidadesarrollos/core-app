<?php

namespace App\Jadmin\Controllers;

use App\Modelos as Modelos;
use Jida\Manager\Estructura;
use Jida\Medios\Mensajes;
use Jida\Medios\Sesion;
use JidaRender as Render;

class SubCentrosCostos extends Jadmin {

    private $_cargo;

    function __construct() {

        parent::__construct();
        $this->modelo = new Modelos\SubCentroCosto();
        $user = new Modelos\User(Sesion::$usuario->obtener('id_usuario'));
        $this->_cargo = strtolower($user->cargo()->identificador);

    }

    function index($idfk = "") {

        if (!in_array($this->_cargo, ['director', 'coordinador'])) {
            $this->redireccionar('/jadmin/actividades');
        }

        $modelo = new Modelos\CentroCosto($idfk);
        if (!$this->solicitudAjax()) {
            $this->layout()->incluirJS([
                Estructura::$urlBase . '/htdocs/js/tablesubcentroscostos.js']);
            $this->layout('jadmin');
        }
        else {
            $this->layout()->incluirJSAjax([
                Estructura::$urlBase . '/htdocs/js/tablesubcentroscostos.js']);
            $this->layout('ajax');
        }

        $this->data(
            ['titulo' => $modelo->centro_costo,
             'idfk'   => $idfk]
        );
    }

    function gestion($idfk = "", $id = "") {

        if (!in_array($this->_cargo, ['director', 'coordinador'])) {
            $this->redireccionar('/jadmin/actividades');
        }

        $form = new Render\Formulario('GestionSubCentrosCostos', $id);
        $form->action = $this->obtUrl('',
            [
                $idfk,
                $id
            ]);
        $modelo = new Modelos\SubCentroCosto($id);

        if ($this->post('btnGestionSubCentrosCostos')) {

            if ($form->validar()) {

                $this->post('id_centro_costo', $idfk);

                if ($modelo->salvar($this->post())) {

                    $accion = (empty($id)) ? 'guardado' : 'modificado';
                    $tipo = 'suceso';
                    $msj = 'Registro <strong>' . $accion . '</strong> exitosamente';
                    Mensajes::almacenar(Mensajes::suceso($msj));
                    $this->redireccionar("/jadmin/sub-centros-costos/{$idfk}");

                }

            }
            else {
                $form::msj('error', 'Los datos ingresados no son v&aacute;lidos');
            }

        }

        $this->data(['form' => $form->render()]);

    }

    function eliminar($idfk = '', $id = '') {

        if (!in_array($this->_cargo, ['director', 'coordinador'])) {
            $this->redireccionar('/jadmin/actividades');
        }

        if (!empty($id)) {

            $modelo = new Modelos\SubCentroCosto($id);

            if (!empty($modelo->id_centro_costo) and $modelo->eliminar()) {
                Mensajes::almacenar(Mensajes::suceso('El registro ha sido eliminado correctamente'));
                $this->redireccionar("/jadmin/sub-centros-costos/{$idfk}");
            }
            else {
                Mensajes::almacenar(Mensajes::error('El registro que desea eliminar no existe'));
                $this->redireccionar("/jadmin/sub-centros-costos/{$idfk}");
            }

        }
        else {
            Mensajes::almacenar(Mensajes::error('El registro que desea eliminar no existe'));
            $this->redireccionar("/jadmin/sub-centros-costos/{$idfk}");
        }

    }

    public function protodata($idfk = "") {

        $modelo = new Modelos\SubCentroCosto();
        $subcentroscostos = (empty($idfk)) ? $modelo->consulta() : $modelo->consulta()->filtro(['id_centro_costo' => $idfk]);
        $subcentroscostos = $subcentroscostos->obt();
        $data = ['data' => $subcentroscostos];

        $this->respuestaJson($data);

    }

}
