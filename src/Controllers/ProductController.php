<?php

namespace Akhaled\Ecommerce\Controllers;

use Akhaled\Ecommerce\Core\Facade\Request;

class ProductController
{
    public function index()
    {
        return Request::all();
    }
}
