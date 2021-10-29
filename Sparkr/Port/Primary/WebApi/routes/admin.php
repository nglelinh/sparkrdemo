<?php

use Carbon\Carbon;
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
    'namespace' => 'Sparkr\Port\Primary\WebApi\Controllers\Admin'
], function () {
//    admin/ping
    Route::get('ping', function () {
        return response('pong', 200);

    });
});

