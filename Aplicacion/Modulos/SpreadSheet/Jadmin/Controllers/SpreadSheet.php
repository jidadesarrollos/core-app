<?php

namespace App\Modulos\SpreadSheet\Jadmin\Controllers;

use Jadmin\Controllers\Control;
use App\Modulos\SpreadSheet\Modelos\SpreadSheet as Excel;
use App\Modelos\Actividad;
use Jida\Medios\Sesion;

class SpreadSheet extends Control {

    public function actividades() {

        $this->layout('vacia');
        $Contr = $this;

        $hojaDeCalculo = new Excel();
        $actividad = new Actividad();

        $sp = 'sp_actividades_usuarios';
        $idUsuario = Sesion::$usuario->obtener('id_usuario');

        if ($Contr->get('owner')) {
            $sp = 'sp_actividades_usuario';
        }

        $datos = $actividad->sp($sp, [$idUsuario]);

        uasort($datos, function ($a, $b) {
            return (new \DateTime($a['fecha_inicio']))->getTimestamp() <
                   (new \DateTime($b['fecha_inicio']))->getTimestamp() ? -1 : 1;
        });

        if ($Contr->get('inicio')) {

            $datos = array_filter($datos, function ($item) use ($Contr) {

                $time1 = new \DateTime($Contr->get('inicio'));
                $time2 = new \DateTime($item['fecha_inicio']);
                $actual = $time1->getTimestamp();
                $despues = $time2->getTimestamp();
                return ($actual <= $despues);

            });

        }
        if ($Contr->get('fin')) {

            $datos = array_filter($datos, function ($item) use ($Contr) {

                $time1 = new \DateTime($Contr->get('fin'));
                $time2 = new \DateTime($item['fecha_entrega']);
                $actual = $time1->getTimestamp();
                $despues = $time2->getTimestamp();
                return ($actual >= $despues);

            });
        }

        if ($Contr->get('empresa')) {

            $datos = array_filter($datos, function ($item) use ($Contr) {

                return $Contr->get('empresa') == $item['empresa'];

            });

        }

        if ($Contr->get('centrocostos')) {

            $datos = array_filter($datos, function ($item) use ($Contr) {

                return $Contr->get('centrocostos') == $item['centro_costo'];

            });

        }

        if ($Contr->get('responsable')) {

            $datos = array_filter($datos, function ($item) use ($Contr) {

                return $Contr->get('responsable') == $item['usuario'];

            });
        }

        if ($Contr->get('buscar')) {

            $datos = array_filter($datos, function ($item) use ($Contr) {

                foreach ($item as $row) {
                    if (strpos($row, $Contr->get('buscar')) !== false) {
                        return true;
                    }
                }
                return false;

            });
        }

        ksort($datos);

        $hojaDeCalculo->creaInserta($datos, [
            'id_actividad'    => 'id',
            'descripcion'     => 'Descripcion',
            'horas'           => 'Horas',
            'fecha_inicio'    => 'Fecha de inicio',
            'fecha_entrega'   => 'Fecha de entrega',
            'empresa'         => 'Empresa',
            'centro_costo'    => 'Centro de costo',
            'subcentro_costo' => 'Subcentro de costo',
            'usuario'         => 'Usuario'
        ]);

        $file = tempnam(sys_get_temp_dir(), 'cost_center_excel');
        $hojaDeCalculo->guardar($file);
        $content = file_get_contents($file);
        unlink($file);
        $fecha = time();
        header("Content-disposition: attachment; filename=actividades_{$fecha}.xls");
        header("Content-type: application/vnd.ms-excel");
        $this->data([
            'file' => $content
        ]);
    }

}
