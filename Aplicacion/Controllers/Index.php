<?php

/**
 * Controlador por defecto
 */

namespace App\Controllers;

use Jida\Core\Curl;

class Index extends App {

    function index() {

        $url = 'https://auth.dev.graphs.social/v4/private/getCredentials';
        $params = [
            'token' => 'ca9511e48c8cb32584cd692d786c91d5|160146'
        ];
        $curl = new Curl();
        $curl->call('get', $url, $params);

        return $this->respuestaJson($curl->arreglo());

    }

    function testpost() {

        $url = 'http://localhost/socites/tdm-api-php/surveys/5d63ed4933343234bed5fc5a';
        $params = [
            "questions_answers" => [
                "u00bfLe parece justo el precio de nuestros productos?"                               => "no",
                "u00bfQuu00e9 productos le gustaria tener en mayor cantidad?"                         => "ninguno",
                "u00bfDesea usted que se le distribuya mayor cantidad de productos de nuestra marca?" => "no",
                "¿Desea usted que se le distribuya mayor cantidad de productos de nuestra marca?"     => "si",
                "¿Qué productos le gustaria tener en mayor cantidad?"                                 => "ninguno",
                "¿Le parece justo el precio de nuestros productos?"                                   => "si"
            ],
            "coverages"         => [
                "5d6f5314303935209b341f41" => [
                    "sku_id"          => "5d6f5314303935209b341f41",
                    "sell_price"      => null,
                    "buy_price"       => null,
                    "coverage_status" => "3"
                ],
                "5d6f532c30393519571c2529" => [
                    "sku_id"          => "5d6f532c30393519571c2529",
                    "sell_price"      => null,
                    "buy_price"       => null,
                    "coverage_status" => "3"
                ],
                "5d6f53b6303935195b2489d7" => [
                    "sku_id"          => "5d6f53b6303935195b2489d7",
                    "sell_price"      => null,
                    "buy_price"       => null,
                    "coverage_status" => "3"
                ],
                "5d6f541b303935209bae1e31" => [
                    "sku_id"          => "5d6f541b303935209bae1e31",
                    "sell_price"      => null,
                    "buy_price"       => null,
                    "coverage_status" => "3"
                ],
                "5d6f5439303935194e4b981d" => [
                    "sku_id"          => "5d6f5439303935194e4b981d",
                    "sell_price"      => null,
                    "buy_price"       => null,
                    "coverage_status" => "3"
                ],
                "5d71d0e73039354423151946" => [
                    "sku_id"          => "5d71d0e73039354423151946",
                    "sell_price"      => null,
                    "buy_price"       => null,
                    "coverage_status" => "3"
                ],
                "5d71e42e30393547f87eaad6" => [
                    "sku_id"          => "5d71e42e30393547f87eaad6",
                    "sell_price"      => null,
                    "buy_price"       => null,
                    "coverage_status" => "3"
                ],
                "5d71e446303935444149c340" => [
                    "sku_id"          => "5d71e446303935444149c340",
                    "sell_price"      => null,
                    "buy_price"       => null,
                    "coverage_status" => "3"
                ],
                "5d71e6ec303935499e90cfe4" => [
                    "sku_id"          => "5d71e6ec303935499e90cfe4",
                    "sell_price"      => null,
                    "buy_price"       => null,
                    "coverage_status" => "3"
                ]
            ],
            "pos_id"            => "5d6d471a30393506f5d45c2e",
            "access_token"      => "39bea935c68321abcdf7554692ed76c0|158791"
        ];
        $curl = new Curl();
        $curl->call('post', $url, $params);

        return $this->respuestaJson($curl->arreglo());

    }

}
