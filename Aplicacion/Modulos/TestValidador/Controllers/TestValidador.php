<?php

/**
 * Creado por Jida Framework
 * 2019-02-26 20:42:24
 */

namespace App\Modulos\TestValidador\Controllers;

use App\Controllers\App;
use Jida\Validador\Validador;

class TestValidador extends App {

    public function index() {
        $valid = Validador::crear([
                    'email' => 'e@maill.com'
                        ], [
                    'email' => 'mail'
        ]);

        $this->data(['mensaje' => 'Controlador ' . self::class, 'datos' => $valid]);
    }

    public function archivo() {
        $valid = Validador::crear([
                    'file' => $_FILES['file']
                        ], [
                    'file' => 'archivo'
        ]);
        $this->data(['mensaje' => 'Controlador ' . self::class, 'datos' => $valid['file']]);
    }

}
