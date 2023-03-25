<?php

namespace Akhaled\Ecommerce\Core\Bootstrap;

use Error;

class Config
{
    private array $config = [];

    function __construct()
    {
        $this->config = include(base_path('.env'));
    }

    public function get(string $key = null, $fallback = null)
    {
        if (is_null($key)) {
            return $this->config;
        }

        try {
            return array_reduce(explode(".", $key), function($carry, $k) {
                return $carry[$k];
            }, $this->config);
        } catch (Error) {
            //
        }

        return $fallback;
    }
}
