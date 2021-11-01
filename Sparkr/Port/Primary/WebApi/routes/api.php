<?php

use Illuminate\Support\Facades\Route;
use Sparkr\Port\Primary\WebApi\Controllers\Api\AuthenticationController;

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
    Route::post('/login', 'LoginController@login');
//    api/ping
    Route::get('ping', function () {
        return response('pong', 200);
    });
});

Route::group([
                 'prefix' => 'auth'
             ], function () {
    Route::post('login', [AuthenticationController::class, 'login']);
    Route::post('signup', [AuthenticationController::class, 'signup']);

//    Route::group([
//                     'middleware' => 'auth:api'
//                 ], function() {
//        Route::delete('logout', 'AuthenticationController@logout');
//        Route::get('me', 'AuthenticationController@user');
//    });
});
