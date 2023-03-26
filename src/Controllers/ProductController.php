<?php

namespace Akhaled\Ecommerce\Controllers;

use Akhaled\Ecommerce\Core\Facade\Request;
use Akhaled\Ecommerce\Core\Facade\Response;

class ProductController
{
    public function index()
    {
        return Response::json(
            Request::all()
        );
    }
}
