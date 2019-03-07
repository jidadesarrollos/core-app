<?php
/**
 * Creado por Jida Framework
 * 2019-03-07 16:58:47
 */

namespace App\Modulos\Test2\Jadmin\Controllers;
  
use Jida\Jadmin\Controllers\JControl;


class Test2 extends JControl{
    
      
    public function index (){
        $this->data(['mensaje' => 'Controlador '.self::class]);

    }
       
}
 
