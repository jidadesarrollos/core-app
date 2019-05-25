<?php
/**
 * Created by PhpStorm.
 * User: Isaac
 * Date: 23/5/2019
 * Time: 01:58
 */

namespace App\Modulos\Recursos\Jadmin\Controllers;

use App\Jadmin\Controllers\Jadmin;
use App\Modulos\Recursos\Jadmin\Controllers\Recursos\Vista;
use App\Modulos\Recursos\Modelos\Recurso;
use Jida\Manager\Estructura;
use Jida\Medios\Cadenas;
use Jida\Medios\Debug;
use Jida\Render\Formulario;
use Jida\Render\JVista;

class Recursos extends Jadmin {

    use Vista;

    function index() {

        $this->vista('jvista');

        $recurso = new Recurso();
        $datos = $recurso
            ->consulta(['id_recurso_humano', 'nombres', 'apellidos'])
            ->join('\App\Modulos\Recursos\Modelos\Tipo',
                ['tipo_recurso'],
                [
                    'clave'          => 'id_tipo_recurso',//El campo de relación en la tabla del join
                    'clave_relacion' => 'id_tipo_recurso'//Campo de relación en la tabla u objeto actual
                ]
            )->obt();

        $vista = $this->_vista($datos);

        $this->data('vista', $vista->render(function ($items) {

            $data = [];
            foreach ($items as $id => $item) {
                $item['nombres'] = $item['nombres'] . ' ' . $item['apellidos'];
                unset($item['apellidos']);
                array_push($data, $item);
            }

            return $data;

        }));

    }

    function gestion($id = "") {

        $form = new Formulario('recursos/gestion', $id);
        $form->action = $this->obtUrl('gestion');

        if ($this->post('btnGestion')) $this->_validar($form, $id);

        $this->data('formulario', $form->render());
    }

    function _validar($form, $id) {

        if ($form->validar()) {

            $recurso = new Recurso($id);
            $identificador = $this->post('nombres') . " " . $this->post('apellidos');
            $recurso->identificador = Cadenas::guionCase($identificador);

            $guardado = $recurso->salvar($this->post());

            if (!$guardado) {

                Formulario::msj('error', "Error registrando al integrante");
                return;

            }

            $msj = 'Integrante del equipo registrado con exito.';
            JVista::msj('vistaRecursos', 'suceso', $msj, Estructura::$urlBase . '/jadmin/recursos');

        }

    }

    function eliminar($id) {
        $recurso = new Recurso($id);
        if ($recurso->id_recurso_humano) {
            $recurso->eliminar();
            $msj = 'Integrante del equipo eliminado con exito.';
            JVista::msj('vistaRecursos', 'suceso', $msj, Estructura::$urlBase . '/jadmin/recursos');
        }

    }
}