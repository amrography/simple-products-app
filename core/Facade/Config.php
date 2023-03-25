<?php

namespace Akhaled\Ecommerce\Core\Facade;

use Akhaled\Ecommerce\Core\Config as CoreConfig;

class Config extends Facade
{
    public static function getFacadeBase(): string
    {
        return CoreConfig::class;
    }
}
