<?php

namespace Akhaled\Ecommerce\Controllers;

use Akhaled\Ecommerce\Core\Facade\Request;
use Akhaled\Ecommerce\Core\Facade\Response;
use Akhaled\Ecommerce\Models\Product;

class ProductController
{
    public function index()
    {
        return Response::json(
            Request::all()
        );
    }

    public function validateSku()
    {
        return Response::json([
            'count' => (int) (new Product)
                ->select('count(*)')
                ->where('sku', Request::post('sku', 'string'))
                ->limit(1)
                ->get()[0]
        ]);
    }
}
