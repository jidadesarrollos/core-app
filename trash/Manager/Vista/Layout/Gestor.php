<?php
/**
 * @see \Jida\Trash\Manager\Vista\Layout
 */

namespace Jida\Trash\Manager\Vista\Layout;

use Jida\Trash\Manager\Estructura;
use Jida\Trash\Manager\Vista\Tema;
use Jida\Medios\Debug;

Trait Gestor {

    private static function _procesarUbicacion($archivo, $tipo) {

        if (strpos($archivo, 'modulo') !== false) {
            $archivo = str_replace('modulo', Estructura::$urlModulo . "/htdocs/$tipo/", $archivo);

        }
        elseif (strpos($archivo, '{tema}')) {
            $archivo = str_replace('{tema}', Tema::$url, $archivo);
        }

        return $archivo;
    }

    public function incluirJS($librerias, $modulo = false) {

        if (is_string($librerias)) {
            $librerias = (array)$librerias;
        }

        foreach ($librerias as $indice => $libreria) {
            $this->_js[$indice] = self::_procesarUbicacion($libreria, "js");
        }

    }

    public function incluirJSAjax($librerias, $modulo = false) {

        if (is_string($librerias)) {
            $librerias = (array)$librerias;
        }

        foreach ($librerias as $indice => $libreria) {
            array_push($this->_jsAjax, self::_procesarUbicacion($libreria, "js"));
        }

    }

    public function incluirCSS($librerias, $modulo = false) {

        if (is_string($librerias)) {
            $librerias = (array)$librerias;
        }

        foreach ($librerias as $indice => $libreria) {
            $this->_css[$indice] = self::_procesarUbicacion($libreria, "css");
        }

    }
}