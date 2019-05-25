<?php

namespace App\Modulos\Recursos\Modelos;

use Jida\Manager\Estructura;

class Recurso extends \Jida\Core\Modelo {

    var $id_recurso_humano;
    var $nombres;
    var $apellidos;
    var $sexo;
    var $email;
    var $telefono_contacto;
    var $id_tipo_recurso;
    var $identificador;

    protected $tablaBD = 'm_recursos_humanos';
    protected $pk = 'id_recurso_humano';

    protected $tieneMuchos = [
        'Media' => [
            'objeto' => "\\App\\Modulos\\Recursos\\Modelos\\Media",
            'campos' => [
                'id_media_proyecto',
                'nombre_archivo',
                'directorio',
                'tipo_media',
                'leyenda',
                'meta_data',
                'id_idioma',
                'titulo',
                'descripcion'
            ]
        ]
    ];

    public function media() {

        $media = [];

        foreach ($this->Media as $id => $mediaItem) {

            $item = array_merge($mediaItem, [
                'url' => json_decode($mediaItem['meta_data'], true)['urls']
            ]);
            array_walk($item['url'],
                function (&$item) {
                    $item = Estructura::$urlBase . $item;
                });

            unset($mediaItem['meta_data']);
            array_push($media, $item);

        }

        return $media;

    }
}
