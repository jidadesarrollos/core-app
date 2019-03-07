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
        
        $valid = Validador::crear(
                ['email1' => 'e@maill.com','email2'=>'e@maill.com,ef@maill.com'], 
                ['email1' => 'mail','email1' => 'mail']);
        $this->data(['mensaje' => 'Controlador ' . self::class, 'datos' => $valid]);
    }

    public function archivo() {
        $valid = Validador::crear(array_merge($_POST, $_FILES), [
                    'file' => 'archivo|mime_type:image/jpeg,image/jpg,image/png',
                    'email' => 'mail|string:lower'
        ]);
        if ($valid->valido()) {
            $name = 'file.' . $valid['file']->getExtension();
            $valid['file']->copy($name);
        }
        $this->data(['mensaje' => 'Controlador ' . self::class, 'datos' => $valid]);
    }

}
