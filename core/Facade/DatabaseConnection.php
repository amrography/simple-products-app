<?php

namespace Akhaled\Ecommerce\Core\Facade;

use Akhaled\Ecommerce\Core\Database\Connection;

class DatabaseConnection extends Facade
{
    public static function getFacadeBase(): string
    {
        return Connection::class;
    }
}
