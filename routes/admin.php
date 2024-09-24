<?php

use App\Http\Controllers\Admin\AddMerchantController;
use App\Http\Controllers\Admin\AddSeminarEventController;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\EventController;
use App\Http\Controllers\Admin\RegisterDigimikroController;
use App\Http\Controllers\Admin\SeminarEventController;
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
        Route::resource('add-seminar-event', AddSeminarEventController::class);
        Route::resource('add-merchant', AddMerchantController::class);
        Route::resource('show-data-merchant', EventController::class);
        Route::resource('seminar-event', SeminarEventController::class);
        Route::resource('register-digimikro', RegisterDigimikroController::class);
    });
});


?>
