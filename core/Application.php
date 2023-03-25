<?php

namespace Akhaled\Ecommerce\Core;

class Application
{
    protected $config = [];

    public function bootstrap()
    {
        $this->readConfig();
    }

    public function readConfig(): self
    {
        $this->config = include(base_path('.env'));

        return $this;
    }
}
