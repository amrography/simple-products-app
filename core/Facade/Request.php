<?php

namespace Akhaled\Ecommerce\Core\Facade;

use Akhaled\Ecommerce\Core\Bootstrap\Request as BootstrapRequest;

class Request extends Facade
{
    public static function getFacadeBase(): string
    {
        return BootstrapRequest::class;
    }
}
