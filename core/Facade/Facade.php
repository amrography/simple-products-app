<?php

namespace Akhaled\Ecommerce\Core\Facade;

use Akhaled\Ecommerce\Core\Bootstrap\Application;
use ErrorException;

abstract class Facade
{
    abstract public static function getFacadeBase(): string;

    final public static function __callStatic(string $function, array $arguments): mixed
    {
        return self::callOrigin($function, $arguments);
    }

    final public function __call(string $function, array $arguments): mixed
    {
        return self::callOrigin($function, $arguments);
    }

    private static function callOrigin(string $function, array $arguments = []): mixed
    {
        try {
            $instance = Application::getInstance(static::getFacadeBase());
        } catch (ErrorException) {
            $instance = Application::setInstance(static::getFacadeBase(), (new (static::getFacadeBase())));
        }

        return $instance->$function(...$arguments);
    }
}
