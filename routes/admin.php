<?php

use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\CategoryAnimalController;
use App\Http\Controllers\Admin\CountryController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SubcategoryAnimalController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;
use Yaro\Jarboe\Facades\Jarboe;
use Yaro\Jarboe\Http\Controllers\DashboardController;

Route::get('dashboard', DashboardController::class . '@dashboard')->name('dashboard');
Jarboe::crud('users', UserController::class);
Jarboe::crud('countries', CountryController::class);
Jarboe::crud('brands', BrandController::class);
Jarboe::crud('category_animals', CategoryAnimalController::class);
Jarboe::crud('subcategory_animals', SubcategoryAnimalController::class);
Jarboe::crud('products', ProductController::class);
