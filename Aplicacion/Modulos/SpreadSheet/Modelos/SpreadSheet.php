<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Modulos\SpreadSheet\Modelos;

use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;

class SpreadSheet {

    /**
     *
     * @var \PhpOffice\PhpSpreadsheet\Spreadsheet
     */
    protected $spreadSheet;
    protected $cabeceras = [];
    protected $activeSheet;

    public function __construct() {
        $this->spreadSheet = new \PhpOffice\PhpSpreadsheet\Spreadsheet();
        $this->activeSheet = $this->spreadSheet->getActiveSheet();
    }

    public function creaInserta($datos, $cabeceras = null) {
        if (!$cabeceras) {
            $cabeceras = [];
            if (count($datos) > 0) {
                foreach ($datos[0] as $i => $item) {
                    $cabeceras[$i] = $i;
                }
            }
        }

        $this->crearCabeceras($cabeceras);
        $this->insertar($datos);
    }

    public function crearCabeceras($cabeceras) {
        $this->cabeceras = [];
        $i = 0;
        foreach ($cabeceras as $key => $item) {
            $char = chr($i + 65);
            $this->cabeceras[$key] = $char;
            $this->activeSheet->setCellValue($char . '1', $item);
            $this->activeSheet->getStyle($char . '1')->getFont()->setBold(true);
            $this->activeSheet->getStyle($char . '1')->getAlignment()->setHorizontal('center');

            if ($char == 'B') {
                $this->activeSheet->getColumnDimension($char)->setWidth('30');
                $this->activeSheet->getStyle('B1:B9999')->getAlignment()->setWrapText(true);
            }
            else {
                $this->activeSheet->getColumnDimension($char)->setAutoSize(true);
            }

            $i++;
        }
    }

    public function insertar($datos) {
        $i = 2;
        foreach ($datos as $item) {
            $this->insertarFila($item, $i++);
        }
    }

    protected function insertarFila($fila, $nfila) {
        foreach ($this->cabeceras as $cabecera => $char) {

            $this->activeSheet->setCellValue($char . $nfila, $fila[$cabecera]);
            if (strpos($cabecera, 'fecha') !== false) {
                $this->activeSheet->getStyle($char . $nfila)
                    ->getNumberFormat()
                    ->setFormatCode(NumberFormat::FORMAT_DATE_YYYYMMDDSLASH);
            }
        }
    }

    public function guardar($fileName) {
        $writer = new Xlsx($this->spreadSheet);
        $file = $fileName;
        $writer->save($file);
        return $file;
    }

}
