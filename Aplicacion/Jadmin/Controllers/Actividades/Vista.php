<?php

namespace App\Jadmin\Controllers\Actividades;

use Jida\BD\DataModel;
use Jida\Manager\Estructura;
use Jida\Medios\Sesion;

trait vista {

    function index() {

        $this->layout()->incluirCSS([
            Estructura::$urlBase . '/htdocs/css/custom.css'
        ]);

        if (!$this->solicitudAjax()) {
            $this->layout()->incluirJS([
                Estructura::$urlBase . '/htdocs/js/tablaActividades.js'
            ]);

            $this->layout('jadmin');
        }
        else {
            $this->layout()->incluirJSAjax([
                Estructura::$urlBase . '/htdocs/js/tablaActividades.js'
            ]);
            $this->layout('ajax');
        }
        $this->data([
            'googleDriveActivo' => false
        ]);
    }

    function misActividades() {

        $this->layout()->incluirCSS([
            Estructura::$urlBase . '/htdocs/css/custom.css'
        ]);

        if (!$this->solicitudAjax()) {
            $this->layout()->incluirJS([
                Estructura::$urlBase . '/htdocs/js/tablaMisActividades.js'
            ]);

            $this->layout('jadmin');
        }
        else {
            $this->layout()->incluirJSAjax([
                Estructura::$urlBase . '/htdocs/js/tablaMisActividades.js'
            ]);
            $this->layout('ajax');
        }
        $this->data([
            'googleDriveActivo' => false
        ]);
    }

    public function protodata() {
        $idUsuario = Sesion::$usuario->obtener('id_usuario');
        $data = DataModel::sp('sp_actividades_usuarios', [$idUsuario]);
        $data = ['data' => $data];
        $this->respuestaJson($data);
    }

    public function actividadesPropias() {
        $idUsuario = Sesion::$usuario->obtener('id_usuario');
        $data = DataModel::sp('sp_actividades_usuario', [$idUsuario]);
        $data = ['data' => $data];
        $this->respuestaJson($data);
    }

}
