<?php

                
/**
 * Creado por Jida Framework
 * 2019-02-26 20:42:24
 */
namespace  App\Modulos\TestValidador\Jadmin\Controllers;

use Jida\Jadmin\Controllers\JControl; 

class TestValidador extends JControl{

    public function index(){

        $this->data(['mensaje' => 'Controlador '.self::class]);
    }
}
