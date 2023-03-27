<?php

namespace Akhaled\Ecommerce\Core\Bootstrap;

class Request
{
    private $base_url;
    private $url;
    private $full_url;
    private $query_string;
    private $script_name;

    /**
     * Handle Request
     *
     *@return void
     */
    function __construct()
    {
        $this->script_name = str_replace('\\', '', dirname($_SERVER['SCRIPT_NAME']));
        $this->setBaseUrl();
        $this->setUrl();
    }

    /**
     * Set Base Url
     *
     * @return void
     */
    public function setBaseUrl()
    {
        $host =  $_SERVER['HTTP_HOST'];
        $script_name = $this->script_name;

        $this->base_url = $host . $script_name;
    }

    /**
    * get base url
    *
    * @return string
    */
    public function baseUrl()
    {
        return $this->base_url;
    }

    /**
     * Set Url
     *
     * @return void
     */
    public function setUrl()
    {
        $request_uri = urldecode($_SERVER['REQUEST_URI']);
        $request_uri = rtrim(preg_replace("#^" . $this->script_name. '#', '', $request_uri), '/');

        $query_string = '';

        $this->full_url = $request_uri;
        if (strpos($request_uri, '?') !== false) {
            list($request_uri, $query_string) = explode('?', $request_uri);
        }

        $this->url = $request_uri?:'/';
        $this->query_string = $query_string;
    }

    /**
    * Get url
    *
    * @return string
    */
    public function url()
    {
        return $this->url;
    }


    /**
     * get method
     *
     * @return string
     */
    public function method()
    {
        return $_SERVER['REQUEST_METHOD'];
    }

    /**
     * check the request has key
     *
     * @param array $type
     * @param string $key
     * @return bool
     */
    public function has($type, $key)
    {
        return array_key_exists($key, $this->all());
    }

    /**
     * get value from the request
     *
     * @param string $key
     * @param array $type
     * @param string $sanitize
     * @return bool
     */
    public function value($key, array $type = null, string $sanitize = null)
    {
        $type = $type ?? $_REQUEST;

        if (!$this->has($type, $key)) {
            return null;
        }

        switch ($sanitize) {
            case 'string':
                return htmlspecialchars($type[$key]);
            case 'float':
                return filter_var($type[$key], FILTER_SANITIZE_NUMBER_FLOAT);
            default:
                return $type[$key];
        }
    }


    /**
     * get datat from get request
     *
     * @param string $key
     * @return string $value
     */
    public function get($key)
    {
        return $this->value($key, $_GET);
    }

    /**
     * get data from post request
     *
     * @param string $key
     * @param string $sanitize
     * @return string $value
     */
    public function post($key, string $sanitize = null)
    {
        return $this->value($key, $_POST, $sanitize);
    }

    /**
     * set value to the request
     *
     * @param string $key
     * @param string $value
     * @return string $value
     */
    public function set($key, $value)
    {
        $_REQUEST[$key] = $value;
        $_POST[$key] = $value;
        $_GET[$key] = $value;
        return $value;
    }

    /**
     * get previous page
     *
     * @return string
     */
    public function previous()
    {
        return $_SERVER['HTTP_REFERER'];
    }

    /**
     * get all request
     *
     * @return array
     */
    public function all()
    {
        return $_REQUEST;
    }
}
