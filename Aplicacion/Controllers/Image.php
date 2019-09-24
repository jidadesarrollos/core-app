<?php

namespace App\Controllers;

use Jida\Core\Controlador\Control;
use Jida
\Medios\Debug;

class Image extends App {

    function index() {

        if ($this->files('fileToUpload')) {
            \Jida\Medios\Debug::imprimir([$_FILES, $this->files()]);
            $this->_carga($this->files('fileToUpload'));
        }

    }

    private function _carga($imagen) {
        $mime = getimagesize($imagen["tmp_name"]);
        \Jida\Medios\Debug::imprimir([$mime], true);

    }
}