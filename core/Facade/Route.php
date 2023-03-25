<?php

namespace Akhaled\Ecommerce\Core\Facade;

use Akhaled\Ecommerce\Core\Bootstrap\Route as BootstrapRoute;

class Route extends Facade
{
    public static function getFacadeBase(): string
    {
        return BootstrapRoute::class;
    }
}
