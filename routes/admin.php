<?php

use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;
use Yaro\Jarboe\Facades\Jarboe;
use Yaro\Jarboe\Http\Controllers\DashboardController;

Route::get('dashboard', DashboardController::class . '@dashboard')->name('dashboard');
Jarboe::crud('users', UserController::class);
