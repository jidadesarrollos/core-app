<?php

define('DIR_JF', __DIR__);

include_once 'vendor/autoload.php';

Jida\Manager::inicio(__DIR__, ['handlers' => '\Jadmin\Handler']);

