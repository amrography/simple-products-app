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

    public function store()
    {
        $data = [
            'sku' => Request::post('sku', 'string'),
            'name' => Request::post('name', 'string'),
            'price' => Request::post('price', 'float') / 100, // store price in cent
            'type' => Request::post('type', 'string'),
        ];

        switch ($data['type']) {
            case 'DVD':
                $attributes = [Request::post('size', 'float')];
                break;
            case 'Book':
                $attributes = [Request::post('weight', 'float')];
                break;
            case 'Furniture':
                $attributes = [Request::post('height', 'float'), Request::post('width', 'float'), Request::post('length', 'float')];
                break;
            default:
                $attributes = [];
                break;
        }

        $data['attributes'] = json_encode($attributes);

        $product = (new Product)->create($data);

        return Response::json($data);
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
