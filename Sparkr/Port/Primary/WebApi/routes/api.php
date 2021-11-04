<?php

use Illuminate\Support\Facades\Route;
use Sparkr\Port\Primary\WebApi\Controllers\Api\AccountController;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "admin" middleware group. Now create something great!
|
*/

Route::group([
                 'namespace' => 'Sparkr\Port\Primary\WebApi\Controllers\Api'
             ], function () {
    //    api/ping
    Route::get('ping', function () {
        return response('pong', 200);
    });
});
Route::post("/refreshToken/", [AccountController::class, 'refreshToken']);

Route::group([
                 'prefix' => 'auth'
             ], function () {
    Route::post('login', [AccountController::class, 'login'])->name('login');
    Route::post('signup', [AccountController::class, 'signup']);
    Route::delete('logout', [AccountController::class, 'logout']);
    Route::group([
                     'middleware' => 'auth:api'
                 ], function () {
        Route::get('me', [AccountController::class, 'user']);
    });
});
