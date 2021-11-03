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
    // Personal list view
    Route::prefix('personal')->group(function () {
        Route::get('/', 'PersonalController@personalProfileList');
        Route::get('/basic-info/{userId}', 'PersonalController@basicPersonalInfo');
        Route::get('/search', 'PersonalController@personalProfileListSearch');
    });

    //    api/ping
    Route::get('ping', function () {
        return response('pong', 200);
    });
});

Route::group([
                 'prefix' => 'auth'
             ], function () {
    Route::post('login', [AccountController::class, 'login']);
    Route::post('signup', [AccountController::class, 'signup']);
    Route::delete('logout', [AccountController::class, 'logout']);
    Route::group([
                     'middleware' => 'auth:api'
                 ], function () {
        Route::get('me', [AccountController::class, 'user']);
    });
});
