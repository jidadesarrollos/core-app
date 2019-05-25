<?php
/**
 * Created by PhpStorm.
 * User: alejandro
 * Date: 26/11/18
 * Time: 08:26 AM
 */

namespace App\Modulos\Recursos\Jadmin\Controllers;

use App\Jadmin\Controllers\Jadmin;
use App\Modulos\Recursos\Jadmin\Controllers\Media\{Carga, Gestion, Vista};
use App\Modulos\Recursos\Modelos\Media as Modelo;
use App\Modulos\Recursos\Modelos\Recurso;
use Jida\Manager\Estructura;
use Jida\Manager\Excepcion;
use Jida\Manager\Vista\Archivo;
use Jida\Medios\Debug;
use Jida\Medios\Directorios;
use Jida\Medios\Archivos\Imagen;
use Jida\Render\JVista;

class Media extends Jadmin {

    use Vista, Gestion, Carga;

    function index($idRecurso = "") {

        $this->layout()->incluirJS([
            'modulo/generic/lightgallery-all.min.js',
            'modulo/generic/mainGaleria.js',
            'modulo/index/jCargaFile.js',
            'modulo/index/galeria.js',
            'modulo/index/acciones.js',
            'modulo/index/index.js'
        ]);

        $this->layout()->incluirCSS([
            'modulo/lightgallery.min.css',
            'modulo/jgallery.css'
        ]);

        if (empty($idRecurso)) {
            $this->redireccionar('/jadmin/recursos/');
        }

        $recurso = new Recurso($idRecurso);

        if (!$recurso->id_recurso_humano) {
            $this->redireccionar('/jadmin/recursos/');

        }

        if ($this->files('imagen')) {
            $this->_procesarCarga($idRecurso, $recurso);

        }


        $this->data([
            'idProyecto' => $idRecurso,
            'nombre'     => "{$recurso->nombres} {$recurso->apellidos}",
            'media'      => $recurso->media(),
            'urlEnvio'   => Estructura::$url
        ]);
    }

    function gestion($idRecurso = "", $id = "") {
        $this->layout()->incluirJSAjax(["modulo/mensajes.js", "modulo/gestion.js"]);
        $this->_gestion($idRecurso, $id);

    }

    function eliminar($id = "") {

        $media = new Modelo($id);
        if (!$media->id_media_proyecto) {
            JVista::msj(
                'vistaProyectos',
                'alerta',
                'No existe el objeto media pasado'
            );
            $this->redireccionar('/recursos');
        }

        if ($this->post('eliminar')) {
            $dirBase = Estructura::$directorio;

            $imagen = new Imagen("{$dirBase}{$media->directorio}/{$media->nombre_archivo}");
            $urls = json_decode($media->meta_data);
            $imagen->editarUrls($urls->urls);


            if (!$media->eliminar() or !$imagen->eliminar()) {
                $this->respuestaJson(['procesado' => false, 'error' => 'mensaje error']);
            }

            $this->respuestaJson(['procesado' => true, 'id' => $id]);
        }

        $this->data([
            'id' => $id
        ]);

    }

}