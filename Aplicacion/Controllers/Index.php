<?php

/**
 * Controlador por defecto
 */

namespace App\Controllers;

class Index extends App {

    function index() {

        $this->layout()->incluirJS(["{base}/Aplicacion/Vistas/index/code.js"]);

    }

}
