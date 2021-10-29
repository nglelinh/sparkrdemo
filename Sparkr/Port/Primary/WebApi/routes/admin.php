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

    // Company
    Route::prefix('company')->group(function () {
        Route::get('/', 'CompanyController@index');
        Route::post('create', 'CompanyController@create');
        Route::post('update/{id}', 'CompanyController@update');
        Route::post('delete/{id}', 'CompanyController@delete');
    });
    // Category
    Route::prefix('category')->group(function () {
        Route::get('/', 'CategoryController@index');
        Route::post('create', 'CategoryController@create');
        Route::post('update/{id}', 'CategoryController@update');
        Route::post('delete/{id}', 'CategoryController@delete');
    });

//    admin/ping
    Route::get('ping', function () {
        return response('pong', 200);

    });
});

