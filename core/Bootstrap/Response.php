<?php

namespace Akhaled\Ecommerce\Core\Bootstrap;

class Response
{
    public function view(string $path)
    {
        ob_start();

        include base_path("resources/views/{$path}.php");

        return ob_get_clean();
    }

    public function json(array $data = [], int $code = 200)
    {
        header('Content-Type: application/json; charset=utf-8');
        http_response_code($code);

        return json_encode($data);
    }
}
