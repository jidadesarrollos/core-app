<?php

namespace App\Jadmin\Controllers\Actividades;

use App\Modelos\Actividad;
use App\Modelos\Prioridad;
use App\Modelos\User;
use Jida\Medios\Mensajes;

trait Asignar {

    public function asignar() {

        if ($this->_tipoUsuario == 2) {
            Mensajes::almacenar(Mensajes::error("No tiene permisos suficientes para ejecutar esta acción."));
            $this->redireccionar('/jadmin/actividades');
        }

        $usuarios = User::listadoUsuarios();
        $prioridad = new Prioridad();

        $this->data([
            'usuarios'    => $usuarios,
            'prioridades' => $prioridad->obtListado()
        ]);

    }

    public function procesar() {

        if ($this->post()) {

            $this->layout('ajax');
            $modelo = new Actividad();

            $this->post('id_estatus', 1);

            if ($modelo->salvar($this->post())) {
                $respuesta = [
                    'status'  => 'ok',
                    'message' => 'Actividad guardada exitosamente',
                    'data'    => [
                        'id_actividad' => $modelo->id_actividad
                    ]
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