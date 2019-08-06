<?php
/**
 * Controlador por defecto
 */

namespace App\Controllers;

use App\Modelos\Miembros;
use Jida\Manager\Textos;
use Jida\Medios\Debug;

class Biografia extends App {

    public $miembros;

    function __construct() {
        parent::__construct();
    }

    function index() {

        /*$miembro = new Miembros();
        $miembros = $miembro->miembros();

        $this->data([
            'miembros' => $miembros
        ]);*/
        /*$textos = Textos::obtener();
        $salida = $textos->arreglo;
        Debug::mostrarArray($salida);*/

    }

    function detalle() {

        $textos = Textos::obtener();
        $salida = $textos->arreglo;
        Debug::mostrarArray($salida);

        /*if (empty($identificador)) {
            $this->redireccionar("/biografia");
        }

        $miembro = new Miembros();
        $miembros = $miembro->miembros();
        $datos = [];
        $ident_correcto = false;

        for ($i = 0; $i < count($miembros); $i++) {
            if ($miembros[$i]['identificador'] === $identificador) {
                $ident_correcto = true;
                $datos = $miembros[$i];
                break;
            }
        }

        if ($ident_correcto === false) {
            $this->redireccionar("/biografia");
        }

        $this->data([
            'datos' => $datos
        ]);*/

    }

}
