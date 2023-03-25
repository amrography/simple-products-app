<?php

namespace Akhaled\Ecommerce\Core\Bootstrap;

use Akhaled\Ecommerce\Core\Config;
use ErrorException;

class Application
{
    protected array $config = [];

    protected static array $instances = [];

    function __construct()
    {
        set_error_handler([$this, 'transformErrorsToExceptions']);
    }

    public function bootstrap()
    {
        $this->setConfigInstance();
    }

    private static function transformErrorsToExceptions($severity, $message, $file, $line)
    {
        if (!(error_reporting() & $severity)) {
            return;
        }
        throw new ErrorException($message, 0, $severity, $file, $line);
    }

    private function setConfigInstance(): self
    {
        self::setInstance(Config::class, new Config);

        return $this;
    }

    /**
     * Get cached instance
     *
     * @param string $key
     * @return object
     */
    public static function getInstance(string $key): object|null
    {
        return self::$instances[$key];
    }

    /**
     * Set object to instances array
     *
     * @param string $key
     * @param object $instance
     * @return self
     */
    public static function setInstance(string $key, object $instance): object
    {
        self::$instances[$key] = $instance;

        return self::$instances[$key];
    }
}
