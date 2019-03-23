<?php
/**
 * Creado por Jida Framework
 * 2019-03-22 22:21:55
 */

namespace App\Modulos\Prueba\Controllers;

use App\Controllers\App;

class Prueba extends App {

    public function index() {

        $this->data(['mensaje' => 'Controlador ' . self::class]);

    }

}
