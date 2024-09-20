<?php

use App\Http\Controllers\Merchant\AddCatalogController;
use App\Http\Controllers\Merchant\Auth\LoginController;
use App\Http\Controllers\Merchant\DashboardController;
use App\Http\Controllers\Merchant\DeleteCatalogController;
use App\Http\Controllers\Merchant\ManagementProductController;
use App\Http\Controllers\Merchant\ProductDetailController;
use App\Http\Controllers\Merchant\ProfileController;
use Illuminate\Support\Facades\Route;

Route::group(['as' => 'merchant.'], function() {
    Route::group(['as' => 'auth.'], function() {
        Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
        Route::post('/login', [LoginController::class, 'login'])->name('store');

        Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
    });

    Route::group([
        'middleware' => ['auth:merchant']
    ], function() {
        // Dashboard
        Route::get('/', DashboardController::class)->name('dashboard');
        Route::resource('add-catalog', AddCatalogController::class);
        Route::resource('delete-catalog', DeleteCatalogController::class);
        Route::resource('management-product', ManagementProductController::class);
        Route::resource('profile', ProfileController::class);
        Route::resource('detail-product', ProductDetailController::class);
    });
});


?>