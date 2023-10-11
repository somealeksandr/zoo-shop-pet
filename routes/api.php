<?php

use App\Http\Controllers\Api\Auth\SignInController;
use App\Http\Controllers\Api\Auth\SignUpController;
use App\Http\Controllers\Api\Animal\AnimalController;
use App\Http\Controllers\Api\Category\CategoryController;
use App\Http\Controllers\Api\Category\SubcategoryController;
use App\Http\Controllers\Api\Product\ProductController;
use App\Http\Controllers\Api\Profile\ProfileController;
use App\Http\Controllers\Api\Subscription\SubscriptionController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/ping', function () {
    return json_encode([
        'title' => 'Ping api',
        'description' => 'Ping api description',
        'version' => 1.0,
    ]);
});

Route::group(['prefix' => 'auth'], function () {
    Route::post('sign-in', [SignInController::class, 'signIn']);
    Route::post('sign-out', [SignInController::class, 'signOut']);
    Route::post('sign-in/two-factor/complete', [SignInController::class, 'completeTwoFactor']);
    Route::post('sign-up', [SignUpController::class, 'signUp']);
    Route::post('sign-up/verify', [SignUpController::class, 'verifyUser']);
    Route::post('sign-up/verify/resend', [SignUpController::class, 'resendVerifyMail']);
    // Route::post('reset-password', [ResetPasswordController::class, 'resetPassword'])->name('user.reset-password');
    // Route::post('reset-password/verify', [ResetPasswordController::class, 'verifyResetPasswordCode'])->name('user.reset-password-verify-code');
    // Route::post('reset-password/confirm', [ResetPasswordController::class, 'resetPasswordConfirm'])->name('user.reset-password-confirm');
});

Route::group(['prefix' => 'profile', 'middleware' => 'auth.jwt'], function () {
   Route::get('/me', [ProfileController::class, 'me']);
   Route::post('/update', [ProfileController::class, 'update']);
   Route::post('/update-password', [ProfileController::class, 'updatePassword']);
});

Route::group(['prefix' => 'subscriptions'], function () {
    Route::post('/create', [SubscriptionController::class, 'create']);
});

Route::get('/animals', [AnimalController::class, 'index']);

Route::get('/categories', [CategoryController::class, 'index']);
Route::get('/subcategories', [SubcategoryController::class, 'index']);
Route::get('/products', [ProductController::class, 'index']);
