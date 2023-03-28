<?php

namespace Akhaled\Ecommerce\Core\Bootstrap;

use Akhaled\Ecommerce\Core\Facade\Request;

class Route
{
    private static $routes = [];

    function __construct()
    {
        require_once base_path("routes/api.php");
        require_once base_path("routes/web.php");
    }

    /**
     * Add a new route
     *
     * @param string $method
     * @param string $uri
     * @param object|callback $callback
     */
    public function add($method, $uri, $callback): self
    {
        $uri = trim($uri, '/');
        $uri = $uri ?: '/';

        array_push(self::$routes, [
            'uri' => $uri,
            'callback'=> $callback,
            'method' => $method,
        ]);

        return $this;
    }

    /**
     * add new get route
     *
     * @param string $uri
     * @param object|callback $callback
     */
    public function get($uri, $callback): self
    {
        return $this->add('GET', $uri, $callback);
    }

    /**
     * add new post route
     *
     * @param string $uri
     * @param object|callback $callback
     */
    public function post($uri, $callback): self
    {
        return $this->add('POST', $uri, $callback);
    }

    /**
     * add new delete route
     *
     * @param string $uri
     * @param object|callback $callback
     */
    public function delete($uri, $callback): self
    {
        return $this->add('DELETE', $uri, $callback);
    }

    public function getRoutes()
    {
        return self::$routes;
    }

    /**
     * Execute the callback
     *
     * @return mixed
     */
    public function handle()
    {
        $matches = preg_grep(
            '#^' . preg_replace('/\/{(.*?)}/', '/(.*?)', Request::url()). '$#',
            array_column(self::$routes, 'uri')
        );

        $endpoint = array_filter(self::$routes, function($v, $k) use($matches) {
            return isset($matches[$k]) && $v['method'] == Request::method();
        }, ARRAY_FILTER_USE_BOTH);

        if (count($endpoint) < 0) {
            die(404);
        }

        $endpoint = count($endpoint) < 1 ?
            self::$routes[0] :
            array_values($endpoint)[0];

        return call_user_func([
            new $endpoint['callback'][0],
            $endpoint['callback'][1]
        ]);
    }
}
