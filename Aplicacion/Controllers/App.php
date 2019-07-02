<?php
/**
 * Controlador Padre
 * aqui va toda la logica en comun que necesiten
 *  los controladores que extienden de el
 */

namespace App\Controllers;

use Jida\Core\Controlador\Control;
use App\Config\Configuracion;
use Jida\Manager\Estructura;

class App extends Control {

    function __construct() {

        parent::__construct();

        $this->layout('principal');

        $this->data([
            'nombreApp' => Configuracion::NOMBRE_APP,
            'urlBase'   => Configuracion::URL_BASE,
            'idioma'    => Estructura::$idioma
        ]);

    }

}
