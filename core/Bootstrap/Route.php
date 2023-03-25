<?php

namespace Akhaled\Ecommerce\Core\Bootstrap;

use Akhaled\Ecommerce\Core\Facade\Request;
use Exception;

class Route
{
    private $routes = [];

    function __construct()
    {
        require_once base_path("routes/api.php");
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

        array_push($this->routes, [
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

    public function getRoutes()
    {
        return $this;
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
            array_column($this->routes, 'uri')
        );

        $endpoint = array_filter($this->routes, function($v, $k) use($matches) {
            return isset($matches[$k]) && $v['method'] == Request::method();
        }, ARRAY_FILTER_USE_BOTH);

        if (count($endpoint) < 0) {
            die(404);
        }

        if (count($endpoint) < 1) {
            throw new Exception("Please provide valid callback function");
        }

        header('Content-Type: application/json; charset=utf-8');

        echo json_encode(
            call_user_func([new $endpoint[0]['callback'][0], $endpoint[0]['callback'][1]])
        );
    }
}
