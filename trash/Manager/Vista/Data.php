<?php

namespace Jida\Trash\Manager\Vista;

use Jida\Core\ObjetoManager;
use Jida\Trash\Manager\Vista\Data\Meta;
use Jida\Trash\Manager\Vista\Data\Plantilla;

class Data {

    use ObjetoManager, Plantilla, Meta;
    private static $data;
    private static $instancia;

    function __construct($data) {

        if (is_object($data)) {
            $this->copiarAtributos($data);
        }

    }

    private static function validarInstancia($data = null) {

        if (!self::$instancia) {
            self::$instancia = new Data($data);
        }

    }

    static function inicializar($data = null) {

        self::validarInstancia($data);

        return self::$instancia;

    }

    /**
     * @return Object Retorna la instancia de un objeto Data
     * @see \Jida\Trash\Manager\Vista
     *
     */
    static function obtener() {

        self::validarInstancia();

        return self::$instancia;

    }

    static function destruir() {
        self::$instancia = false;
    }
}