<?php

namespace App\Config;

use Jida\Configuracion\Config;

class Configuracion extends Config {

    const NOMBRE_APP = 'Aplicación Jida';
    const ENTORNO_APP = 'dev';
    const URL_BASE = '';
    const URL_ABSOLUTA = '';
    const PATH_JIDA = "jida";
    const ENVIAR_EMAIL_ERROR = false;
    const EMAIL_SOPORTE = 'soporte@jidadesarrollos.com';
    const HASH_CLAVE = "password_hash"; // opciones: password_hash, md5

    public $tema     = 'default';
    public $idiomas  = [
        'es' => 'Español'
    ];
    static $modulos  = [
        'TestGestor',
        'TestValidador'
    ];
    public $logo     = 'default/htdocs/img/logo.png';
    public $mensajes = [
        'error'  => 'alert alert-danger',
        'suceso' => 'alert alert-success',
        'alert'  => 'alert alert-warning',
        'info'   => 'alert alert-info'
    ];

    const REDIMENSION_IMAGEN = [
        '150x150',
        '400x400',
        '800x800',
        '1200x1200'
    ];

    function __construct() {

        $this->definir('configMensajes', $this->mensajes);
        $this->definir('tema',
            [
                'configuracion' => $this->tema
            ]);

        self::$modulos['app'] = 'app';

        /**
         * @since 0.6
         */
        $GLOBALS['JIDA_CONF'] = $this;
    }

    private function definir($variable, $valor) {

        $GLOBALS[$variable] = $valor;
    }

    public function inicio() {

    }

    static function obtener() {

    }

}
