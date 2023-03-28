<?php

namespace Akhaled\Ecommerce\Core\Facade;

use Akhaled\Ecommerce\Core\Bootstrap\Application;
use ErrorException;

abstract class Facade
{
    abstract public static function getFacadeBase(): string;

    final public static function __callStatic(string $function, array $arguments)
    {
        return self::callOrigin($function, $arguments);
    }

    final public function __call(string $function, array $arguments)
    {
        return self::callOrigin($function, $arguments);
    }

    private static function callOrigin(string $function, array $arguments = [])
    {
        try {
            $instance = Application::getInstance(static::getFacadeBase());
            if (is_null($instance)) {
                throw new ErrorException;
            }
        } catch (ErrorException $e) {
            $instance = static::getFacadeBase();
            $instance = Application::setInstance(static::getFacadeBase(), new $instance);
        }

        return $instance->$function(...$arguments);
    }
}
