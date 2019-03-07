<?php
/**
 * Creado por Jida Framework
 * 2019-03-07 16:58:47
 */

namespace App\Modulos\Test2\Controllers;
  
use App\Controllers\App;


class Test2 extends App{
    
      
    public function index (){
        $this->data(['mensaje' => 'Controlador '.self::class]);

    }
       
}
 
