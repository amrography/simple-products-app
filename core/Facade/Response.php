<?php

namespace Akhaled\Ecommerce\Core\Facade;

use Akhaled\Ecommerce\Core\Bootstrap\Response as BootstrapResponse;

class Response extends Facade
{
    public static function getFacadeBase(): string
    {
        return BootstrapResponse::class;
    }
}
