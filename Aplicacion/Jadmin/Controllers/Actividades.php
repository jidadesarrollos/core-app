<?php

namespace App\Jadmin\Controllers;

use App\Jadmin\Controllers\Actividades\Asignar;
use App\Jadmin\Controllers\Actividades\Bandeja;
use App\Jadmin\Controllers\Actividades\Gestion;
use App\Jadmin\Controllers\Actividades\Vista;
use App\Modelos as Modelos;
use Jida\Medios\Mensajes;
use Jida\Medios\Sesion;

class Actividades extends Jadmin {

    use Gestion, Vista, Asignar, Bandeja;

    public $msj;
    private $_tipoUsuario;

    function __construct() {

        parent::__construct();
        $this->modelo = new Modelos\Actividad();
        $user = new Modelos\User(Sesion::$usuario->obtener('id_usuario'));
        $this->_tipoUsuario = $user->tipo_usuario;

    }

    function eliminar($id = '') {

        if ($this->_tipoUsuario == 2) {
            Mensajes::almacenar(Mensajes::error("No tiene permisos suficientes para ejecutar esta acción."));
            $this->redireccionar('/jadmin/actividades');
        }

        if (!empty($id)) {

            $modelo = new Modelos\Actividad($id);

            if (!empty($modelo->id_actividad)) {

                $this->modelo->sp('sp_remover_horas', [$modelo->id_actividad]);
                $modelo->eliminar();
                Mensajes::almacenar(Mensajes::suceso('El registro ha sido eliminado correctamente'));
                $this->redireccionar('/jadmin/actividades/');
            }
            else {
                Mensajes::almacenar(Mensajes::error('El registro que desea eliminar no existe'));
                $this->redireccionar('/jadmin/actividades/');
            }
        }
        else {
            Mensajes::almacenar(Mensajes::error('El registro que desea eliminar no existe'));
            $this->redireccionar('/jadmin/actividades/');
        }
    }

}
