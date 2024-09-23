<?php

use App\Http\Controllers\Customer\CartController;
use App\Http\Controllers\Customer\ContactController;
use App\Http\Controllers\Customer\DashboardController;
use App\Http\Controllers\Customer\ItemDetailController;
use App\Http\Controllers\Customer\ProfileController;
use App\Http\Controllers\Customer\ShopController;
use App\Http\Controllers\Customer\TestimonialController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

Route::group([
    'as' => 'public.'
], function(){
    Route::get('/', DashboardController::class)->name('dashboard');
    Route::resource('contact', ContactController::class);
    Route::resource('detail', ItemDetailController::class);
    Route::resource('shop', ShopController::class);
    Route::resource('testimonial', TestimonialController::class);
}

);
