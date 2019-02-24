<?php

define('DIR_JF', __DIR__);

include_once 'vendor/autoload.php';

$jida = new Jida\Manager(__DIR__);
$jida->inicio();
