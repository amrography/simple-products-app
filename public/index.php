<?php

require_once __DIR__ . '/../vendor/autoload.php';

$x = (new \Akhaled\Ecommerce\Core\Bootstrap\Application)
    ->respond();

dd($x);
