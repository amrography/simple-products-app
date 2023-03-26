<?php

namespace Akhaled\Ecommerce\Controllers;

use Akhaled\Ecommerce\Core\Facade\Response;

class HomeController
{
    public function index()
    {
        return Response::view('index');
    }
}
