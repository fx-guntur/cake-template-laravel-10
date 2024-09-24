<?php

use App\Http\Controllers\Admin\AddMerchantController;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ShowDataCustomerController;
use App\Http\Controllers\Admin\ShowDataMerchantController;
use App\Http\Controllers\Admin\ShowDataTransactionController;
use Illuminate\Support\Facades\Route;

Route::group(['as' => 'admin.'], function() {
    Route::group(['as' => 'auth.'], function() {
        Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
        Route::post('/login', [LoginController::class, 'login'])->name('store');

        Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
    });

    Route::group([
        'middleware' => ['auth:admin']
    ], function() {
        // Dashboard
        Route::get('/', DashboardController::class)->name('dashboard');
        Route::resource('add-merchant', AddMerchantController::class);
        Route::resource('customer-data', ShowDataCustomerController::class);
        Route::resource('merchant-data', ShowDataMerchantController::class);
        Route::resource('transaction-data', ShowDataTransactionController::class);
    });
});


?>
