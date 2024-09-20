<?php

use App\Http\Controllers\Customer\Auth\LoginController;
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

        Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
    });

    Route::group([
        'middleware' => ['auth:customer']
    ], function() {
        // Dashboard
        Route::get('/', DashboardController::class)->name('dashboard');
        Route::resource('cart', CartController::class);
        Route::resource('checkout', CheckoutController::class);
        Route::resource('contact', ContactController::class);
        Route::resource('profile', ProfileController::class);
        Route::resource('detail', ItemDetailController::class);
        Route::resource('shop', ShopController::class);
        Route::resource('testimonial', TestimonialController::class);
    });
});


?>