<?php

namespace App\Jadmin\Controllers\Actividades;

use App\Modelos\Actividad;
use App\Modelos\ComentarioActividad;
use App\Modelos\EstatusActividad;
use Jida\Medios\Debug;
use Jida\Medios\Sesion;

trait Bandeja {

    public function bandeja() {

        $estatusActividad = new EstatusActividad();
        $statusList = $estatusActividad->consulta()->obt();

        $this->data([
            'statusActividades' => $statusList
        ]);

    }

    public function obtbandeja() {

        $this->layout('ajax');

        if ($this->post('getdata')) {

            $modelo = new Actividad();
            $idUsuario = Sesion::$usuario->obtener('id_usuario');
            $actividades = $modelo->obtActividadesBandeja($idUsuario);

            $respuesta = [
                'status' => 'ok',
                'data'   => $actividades
            ];

            $this->respuestaJson($respuesta);

        }

    }

    public function actualizar() {

        $this->layout('ajax');

        if ($this->post('id_actividad')) {

            $id = $this->post('id_actividad');

            $modelo = new Actividad($id);

            if ($modelo->salvar($this->post())) {

                $data = [
                    'comentario'   => $this->post('comentario'),
                    'id_actividad' => $modelo->id_actividad
                ];

                $comentario = new ComentarioActividad();
                $comentario->salvar($data);

                $respuesta = [
                    'status'  => 'ok',
                    'message' => 'Actividad actualizada exitosamente'
                ];
            }
            else {
                $respuesta = [
                    'status'  => 'error',
                    'message' => 'No se pudo guardar la actividad'
                ];
            }

            $this->respuestaJson($respuesta);

        }

    }

}