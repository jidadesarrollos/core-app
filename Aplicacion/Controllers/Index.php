<?php

/**
 * Controlador por defecto
 */

namespace App\Controllers;

use Jida\Manager\Textos;
use Jida\Medios\Debug;

class Index extends App {

    function index() {

        $textos = Textos::obtener();
        $salida = $textos->arreglo;
        Debug::mostrarArray($salida);
    }

}
