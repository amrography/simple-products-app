<?php

namespace Akhaled\Ecommerce\Core\Bootstrap;

use Akhaled\Ecommerce\Core\Database\Connection;
use Akhaled\Ecommerce\Core\Facade;
use Akhaled\Ecommerce\Core\Facade\DatabaseConnection;
use ErrorException;

class Application
{
    protected array $config = [];

    protected static array $instances = [];

    function __construct()
    {
        set_error_handler([$this, 'transformErrorsToExceptions']);
        $this->registerContainerInstances();
    }

    public function respond()
    {
        echo Facade\Route::handle();

        DatabaseConnection::close();

        exit;
    }

    public static function transformErrorsToExceptions($severity, $message, $file, $line)
    {
        if (!(error_reporting() & $severity)) {
            return;
        }
        throw new ErrorException($message, 0, $severity, $file, $line);
    }

    private function registerContainerInstances(): self
    {
        self::setInstance(Facade\Config::class, new Config);
        self::setInstance(Facade\DatabaseConnection::class, new Connection);
        self::setInstance(Facade\Route::class, new Route);

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
