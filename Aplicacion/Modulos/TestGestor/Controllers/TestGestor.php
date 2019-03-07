<?php
/**
 * Creado por Jida Framework
 * 2019-03-07 16:51:58
 */

namespace App\Modulos\TestGestor\Controllers;
  
use App\Controllers\App;
use Jida\BD\Sql\Tabla;

class TestGestor extends App{
    
      
    public function index (){
        
        $comunas=[
            [
                'name'=>'id',
                'type'=>'int',
                'primary'=>true,
                'autoincrement'=>true
            ],
            [
                'name'=>'campo1',
                'type'=>'varchar(12)'
            ]
            ,
            [
                'name'=>'campo2',
                'type'=>'varchar(12)',
                'unique'=>true
            ]
        ];
        $clavesForaneas=[
            [
                'key'=>'id',
                'reference'=>'test2'
            ],
            [
                'key'=>'campo2',
                'reference'=>'test2',
                'keyReference'=>'id'
            ]
            
        ];
        $tabla= new Tabla('test', $comunas, $clavesForaneas);
        $this->data(['mensaje' => $tabla->sql(),'class'=>Tabla::class]);

    }
       
}
 
