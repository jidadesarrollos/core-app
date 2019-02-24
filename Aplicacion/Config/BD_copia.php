<?php
/**
 * Objeto para configuración de base de datos
 *
 */

namespace App\Config;

class BD {

    var $manejador = 'MySQL';
    var $default = [
        'puerto'   => "3306",
        'usuario'  => 'root',
        'clave'    => '123456',
        'bd'       => 'app',
        'servidor' => '127.0.0.1',
    ];
}
