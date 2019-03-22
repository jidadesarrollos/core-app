<?php
/**
 * Creado por Jida Framework
 * 2019-03-07 16:51:58
 */

namespace App\Modulos\TestGestor\Jadmin\Controllers;
  
use Jida\Jadmin\Controllers\JControl;


class TestGestor extends JControl{
    
      
    public function index (){
        $this->data(['mensaje' => 'Controlador '.self::class]);

    }
       
}
 
