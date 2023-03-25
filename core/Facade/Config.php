<?php

namespace Akhaled\Ecommerce\Core\Facade;

use Akhaled\Ecommerce\Core\Bootstrap\Config as BootstrapConfig;

class Config extends Facade
{
    public static function getFacadeBase(): string
    {
        return BootstrapConfig::class;
    }
}
