<?php

use Akhaled\Ecommerce\Controllers\ProductController;
use Akhaled\Ecommerce\Core\Facade\Route;

Route::get("/api/products", [ProductController::class, 'index']);
Route::post("/api/products", [ProductController::class, 'store']);
Route::post("/api/delete-products", [ProductController::class, 'destroy']);
Route::post("/api/products/validate-sku", [ProductController::class, 'validateSku']);
