<?php

namespace App\Jadmin\Controllers;

use App\Modelos\User;
use Jadmin\Controllers\Control;
use Jida\Medios\Sesion;
use JidaRender\Menu;

class Jadmin extends Control {

    function __construct() {
        parent::__construct();

        $user = new User(Sesion::$usuario->obtener('id_usuario'));
        $cargo = strtolower($user->cargo()->identificador);

        if ($cargo === 'director' or $cargo === 'coordinador') {
            $menu = new Menu('/jadmin/menucoord');
        }
        else {
            $menu = new Menu('/jadmin/menu');
        }

        $menu->addClass('navigation-left');
        $this->data([
            'menu' => $menu->render(),
        ]);

    }

    function index() {

        $this->redireccionar('/jadmin/actividades');

    }

}