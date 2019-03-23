<?php
/**
 * Creado por Jida Framework
 * 2019-03-22 22:21:55
 */

namespace App\Modulos\Prueba\Jadmin\Controllers;
  
use Jida\Jadmin\Controllers\JControl;

class Prueba extends JControl{
      
    public function index (){
    
        $this->data(['mensaje' => 'Controlador '.self::class]);

    }
    
}
