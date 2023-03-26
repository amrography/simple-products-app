<?php

use Akhaled\Ecommerce\Controllers\HomeController;
use Akhaled\Ecommerce\Core\Facade\Route;

Route::get("/", [HomeController::class, 'index']);
