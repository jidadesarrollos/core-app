<?php
/**
 * Controlador por defecto
 */

namespace App\Controllers;

use Jida\Medios\Debug;

class Index extends App {

    function index($url = "") {
        $url = 'hola-mundo';
        $post = $this->_obtPost($url);
        $this->data([
            'titulo'    => $post->post,
            'contenido' => $post->contenido
        ]);
    }

}
