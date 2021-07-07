<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\MainController;
use App\Http\Controllers\FindReplaceController;
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

    Route::group(['prefix' => 'find-replace'], function () {

        Route::get('/',        [FindReplaceController::class, 'index'])->name('findReplace');
        Route::post('search',  [FindReplaceController::class, 'search'])->name('findReplace.search');
        Route::post('replace', [FindReplaceController::class, 'replace'])->name('findReplace.replace');
    });
});
