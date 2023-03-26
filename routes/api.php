<?php

use Akhaled\Ecommerce\Controllers\ProductController;
use Akhaled\Ecommerce\Core\Facade\Route;

Route::get("/api/products", [ProductController::class, 'index']);
