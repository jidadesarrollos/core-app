<?php
/**
 * Created by PhpStorm.
 * User: Isaac
 * Date: 23/5/2019
 * Time: 02:51
 */

namespace App\Modulos\Recursos\Jadmin\Controllers\Recursos;

use Jida\Manager\Estructura;
use Jida\Render\JVista;
use Jida\Render\Selector;

Trait Vista {

    function _vista($data) {

        $params = [
            'titulos' => [
                'Nombre',
                'Tipo'
            ]
        ];

        $jvista = new JVista($data, $params, 'Recursos');
        $jvista->controlFila = 3;
        $jvista->accionesFila([

            [
                'span'  => 'fa fa-images',
                'title' => "Portafolio",
                'href'  => "/jadmin/recursos/media/{clave}",
            ],

            [
                'span'  => 'fa fa-edit',
                'title' => "Editar",
                'href'  => "/jadmin/recursos/gestion/{clave}",
            ],

            [
                'span'        => 'fa fa-trash',
                'title'       => "Eliminar Formulario",
                'href'        => "/jadmin/recursos/eliminar/{clave}",
                'data-class'  => 'eliminar',
                'data-jvista' => 'confirm',
                'data-msj'    => '<h3>¡Cuidado!</h3>&iquest;Realmente desea eliminar el formulario seleccionado?'
            ],

        ]);
        $atributo = ['href' => "/jadmin/recursos/gestion"];
        $jvista->acciones(['Nuevo' => $atributo]);

        $a = Selector::crear('a.btn', $atributo, "Agregar recursos");
        $jvista->addMensajeNoRegistros("No hay recursos registrados <br/> {$a}");
        return $jvista;

    }
}