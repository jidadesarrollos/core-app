<?php

namespace App\Config;

use Jida\Configuracion\Config;

class Configuracion extends Config {

    const NOMBRE_APP = 'Cost Center';
    const ENTORNO_APP = 'dev';
    const URL_BASE = '';
    const URL_ABSOLUTA = '';
    const ENVIAR_EMAIL_ERROR = false;
    const EMAIL_SOPORTE = 'soporte@jidadesarrollos.com';
    const HASH_CLAVE = "md5"; // opciones: password_hash, md5
    const IDIOMA_DEFAULT = "es";
    static $idioma = "es";

    public $tema = 'default';

    public $idiomas = [
        'es' => 'Español'
    ];

    // Braintree
    const BRAINTREE_CONFIG = [
        'environment' => 'sandbox',
        'merchantId'  => 'rmrz8jbp93hbk92j',
        'publicKey'   => 'ywrtgzwrwwdfw2kf',
        'privateKey'  => '329901d95e0903c3e53ef70ce793da6b'
    ];

    static $modulos = [
        'Jadmin',
        'Empresas',
        'SpreadSheet',
        'Braintree'
    ];

    public $logo = '/htdocs/img/logo.png';

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
        $this->definir('tema', ['configuracion' => $this->tema]);

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
