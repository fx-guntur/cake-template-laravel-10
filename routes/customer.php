<?php

use App\Http\Controllers\Customer\Auth\LoginController;
use App\Http\Controllers\Customer\Auth\RegisterController;
use App\Http\Controllers\Customer\CartController;
use App\Http\Controllers\Customer\CheckoutController;
use App\Http\Controllers\Customer\ContactController;
use App\Http\Controllers\Customer\DashboardController;
use App\Http\Controllers\Customer\ItemDetailController;
use App\Http\Controllers\Customer\ProfileController;
use App\Http\Controllers\Customer\ShopController;
use App\Http\Controllers\Customer\TestimonialController;
use Illuminate\Support\Facades\Route;

Route::group(['as' => 'customer.'], function() {
    Route::group(['as' => 'auth.'], function() {
        Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
        Route::post('/login', [LoginController::class, 'login'])->name('store');

        Route::get('/register', [RegisterController::class, 'showRegisterForm'])->name('register');
        Route::post('/register', [RegisterController::class, 'register'])->name('create');

        Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
    });

    Route::group([
        'middleware' => ['auth:customer']
    ], function() {
        // Dashboard
        Route::resource('checkout', CheckoutController::class);
        Route::resource('profile', ProfileController::class);
        Route::resource('cart', CartController::class);
    });
});


?>