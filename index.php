<?php

define('DIR_JF', __DIR__);

include_once 'vendor/autoload.php';

$codes = [
    ['code' => '1235', 'has_code' => false],
    ['code' => '1235', 'has_code' => false],
    ['code' => '1235', 'has_code' => false],
];
array_walk($codes, function ($key, $value) {
    \Jida\Medios\Debug::imprimir([$key, $value]);
});
\Jida\Medios\Debug::imprimir(["si"], true);

Jida\Manager::inicio(__DIR__, ['handlers' => '\Jadmin\Handler']);

