<?php

namespace App\Controllers;

use App\Config\Configuracion;
use Jida\Core\Controlador\Control;

class App extends Control {

    protected $Layout = '';

    function __construct() {

        parent::__construct();

        $this->layout('default');
        $this->data('title', Configuracion::NOMBRE_APP);

        //   $this->redireccionar('/jadmin');

    }

}
