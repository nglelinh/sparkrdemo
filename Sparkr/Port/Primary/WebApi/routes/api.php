<?php

use Illuminate\Support\Facades\Route;
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
