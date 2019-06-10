<?php

/**
 * Controlador por defecto
 */

namespace App\Controllers;

class Index extends App {

    function index() {

        $og = [
            'og:title' => 'Aplicación Jida',
            'og:type'  => 'website',
            'og:url'   => 'http://localhost/jidadesarrollos/core-app/',
            'og:image' => 'http://localhost/jidadesarrollos/core-app/htdocs/img/logo.png'
        ];

        $this->layout()->openGraph($og);

    }

}
