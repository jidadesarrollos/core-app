<?php

/**
 * Clase Modelo
 *
 * @author Julio Rodriguez
 * @package
 * @version
 * @category
 */

namespace App\Config;

class Mail {

    var $index = [
        'Username'   => 'pruebas@jidadesarrollos.com',
        'Password'   => 'pru3b45',
        'From'       => 'pruebas@jidadesarrollos.com',
        'FromName'   => Configuracion::NOMBRE_APP,
        'Host'       => 'gtr.websitewelcome.com',
        'Port'       => 465,
        'SMTPSecure' => 'ssl'
    ];
    var $data = [
        'nombre_app' => Configuracion::NOMBRE_APP,
        'url_sitio'  => Configuracion::URL_BASE,
        'url_app'    => Configuracion::URL_BASE,
        'logo_app'   => 'http://jidadesarrollos.com/htdocs/img/jida/jida_solid.png'
    ];

}
