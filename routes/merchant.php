<?php

use App\Http\Controllers\Merchant\AddCatalogController;
use App\Http\Controllers\Merchant\Auth\LoginController;
use App\Http\Controllers\Merchant\DashboardController;
use App\Http\Controllers\Merchant\DeleteCatalogController;
use App\Http\Controllers\Merchant\ManagementProductController;
use App\Http\Controllers\Merchant\ProductDetailController;
use App\Http\Controllers\Merchant\ProfileController;
use App\Http\Controllers\Merchant\ShowTransactionController;
use App\Http\Controllers\Merchant\ProductController;
use Illuminate\Support\Facades\Route;

Route::group(['as' => 'merchant.'], function () {
    Route::group(['as' => 'auth.'], function () {
        Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
        Route::post('/login', [LoginController::class, 'login'])->name('store');

        Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
    });

    Route::group([
        'middleware' => ['auth:merchant']
    ], function () {
        // Dashboard
        Route::get('/', DashboardController::class)->name('dashboard');
        Route::resource('add-catalog', AddCatalogController::class);
        Route::resource('delete-catalog', DeleteCatalogController::class);
        Route::resource('management-product', ManagementProductController::class);
        Route::resource('profile', ProfileController::class);
        Route::resource('previewProduct', ProductDetailController::class);
        Route::resource('show-transaction', ShowTransactionController::class);
        Route::resource('show-product', ProductController::class);
        // Product Routes
        Route::get('/product/data', [ProductController::class, 'getData'])->name('product.getData');
        // transaction Routes
        Route::get('/transaction/data', [ShowTransactionController::class, 'getData'])->name('transaction.getData');
        Route::get('/product/store', [ProductController::class, 'store'])->name('product.store');
        // Route to handle the form submission (POST)
        Route::post('/product/store', [ProductController::class, 'store'])->name('merchant.product.store');

        // Route to display the form (GET)
        Route::get('/product/create', [ProductController::class, 'create'])->name('merchant.product.create');

        // Route to handle the form submission (POST)
        // Route::post('/merchant/product/store', [ProductController::class, 'store'])->name('merchant.product.store');

        // Detail product preview route
        Route::resource('previewProduct', ProductDetailController::class); // Detail produk

    });
});
