<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MainController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', [MainController::class, 'main'])->name('main');

Route::group(['prefix' => 'auth'], function () {
    Route::get('redirect', [AuthController::class, 'redirect'])->name('auth.redirect');
    Route::get('callback', [AuthController::class, 'callback'])->name('auth.callback');
});
