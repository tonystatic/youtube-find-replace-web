<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\ToolsController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

Route::get('/', [MainController::class, 'main'])->name('main');

Route::group(['middleware' => 'guest'], function () {

    Route::group(['prefix' => 'auth'], function () {

        Route::get('redirect', [AuthController::class, 'redirect'])->name('auth.redirect');
        Route::get('callback', [AuthController::class, 'callback'])->name('auth.callback');
    });
});

Route::group(['middleware' => 'auth'], function () {

    Route::get('home', [MainController::class, 'home'])->name('home');

    Route::get('logout', [AuthController::class, 'logout'])->name('logout');

    Route::get('find-replace', [ToolsController::class, 'findReplace'])->name('findReplace');
});
