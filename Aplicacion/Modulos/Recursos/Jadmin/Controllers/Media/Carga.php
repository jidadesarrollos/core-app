<?php
/**
 * @see \Jida\Core\Controlador
 */

namespace App\Modulos\Recursos\Jadmin\Controllers\Media;

use App\Modulos\Recursos\Modelos\Media;
use Jida\Configuracion\Config;
use Jida\Manager\Estructura;
use Jida\Medios\Archivos\Imagen;
use Jida\Medios\Archivos\ProcesadorCarga;

Trait Carga {

    private function _procesarCarga($idRecurso, $recurso) {

        $imagen = $this->files('imagen');

        $procesador = new ProcesadorCarga('imagen');
        $media = new Media();

        $configuracion = Config::obtener();

        if ($procesador->validar()) {

            $path = Estructura::$directorio;
            $directorio = "{$path}/htdocs/img/{$recurso->identificador}";
            $archivos = $procesador->mover($directorio)->archivos();

            $ok = true;
            $datos = $imagenes = [];

            foreach ($archivos as $item => $archivo) {

                $imagen = new Imagen($archivo->directorio());

                if (!$imagen->redimensionar($configuracion::REDIMENSION_IMAGEN)) {
                    $ok = false;
                    continue;
                }

                array_push($datos, $this->_data($imagen, $idRecurso));
                array_push($imagenes, ['urls' => $imagen->obtUrls()]);

            }

            $media->salvarTodo($datos);
            $ids = $media->obtIdsResultados();
            foreach ($ids as $key => $id) {
                $imagenes[$key]['id'] = $id;
            }

            $this->respuestaJson([
                'procesado'  => $ok,
                'data'       => $imagenes,
                'directorio' => $directorio
            ]);

        }

    }

    private function _data(Imagen $imagen, $idRecurso) {

        return [
            'nombre_archivo' => $imagen->nombre,
            'tipo_media'     => $imagen->tipo,
            'directorio'     => str_replace(Estructura::$directorio, "", $imagen->directorio),
            'id_recurso_humano'    => $idRecurso,
            'meta_data'      => json_encode(['urls' => str_replace(Estructura::$urlBase, "", $imagen->obtUrls())]),
            'id_idioma'      => 'esp'
        ];

    }

}