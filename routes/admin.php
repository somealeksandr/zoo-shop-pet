<?php

use App\Http\Controllers\Admin\BrandController;
use App\Http\Controllers\Admin\AnimalController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\CategoryNewsController;
use App\Http\Controllers\Admin\CountryController;
use App\Http\Controllers\Admin\GeneralSettingsController;
use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\Admin\OfferByAnimalController;
use App\Http\Controllers\Admin\ProductController;
use App\Http\Controllers\Admin\SubcategoryController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;
use Yaro\Jarboe\Facades\Jarboe;
use Yaro\Jarboe\Http\Controllers\DashboardController;

Route::get('dashboard', DashboardController::class . '@dashboard')->name('dashboard');
Jarboe::crud('users', UserController::class);
Jarboe::crud('countries', CountryController::class);
Jarboe::crud('brands', BrandController::class);
Jarboe::crud('animals', AnimalController::class);
Jarboe::crud('categories', CategoryController::class);
Jarboe::crud('subcategories', SubcategoryController::class);
Jarboe::crud('products', ProductController::class);
Jarboe::crud('category-news', CategoryNewsController::class);
Jarboe::crud('news', NewsController::class);
Jarboe::crud('general-settings', GeneralSettingsController::class);
Jarboe::crud('offer-by-animals', OfferByAnimalController::class);
