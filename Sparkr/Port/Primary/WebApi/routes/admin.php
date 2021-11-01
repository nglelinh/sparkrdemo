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

    // User
    Route::prefix('user')->group(function () {
        Route::get('/', 'UserController@index');
        Route::post('create', 'UserController@create');
        Route::post('update/{id}', 'UserController@update');
        Route::post('delete/{id}', 'UserController@delete');
    });

    // Company
    Route::prefix('company')->group(function () {
        Route::get('/', 'CompanyController@index');
        Route::get('/{id}', 'CompanyController@viewProfile');
        Route::post('create', 'CompanyController@create');
        Route::post('update/{id}', 'CompanyController@update');
        Route::post('update-status/{id}', 'CompanyController@updateStatus');
        Route::post('delete/{id}', 'CompanyController@delete');
    });
    // Personal
    Route::prefix('personal')->group(function () {
        Route::get('/', 'PersonalController@index');
        Route::get('/{id}', 'PersonalController@viewProfile');
        Route::post('create', 'PersonalController@create');
        Route::post('update/{id}', 'PersonalController@update');
        Route::post('update-status/{id}', 'PersonalController@updateStatus');
        Route::post('delete/{id}', 'PersonalController@delete');
    });
    // Category
    Route::prefix('category')->group(function () {
        Route::get('/', 'CategoryController@index');
        Route::post('create', 'CategoryController@create');
        Route::post('update/{id}', 'CategoryController@update');
        Route::post('delete/{id}', 'CategoryController@delete');
    });
    // JobType
    Route::prefix('job-type')->group(function () {
        Route::get('/', 'JobTypeController@index');
        Route::post('create', 'JobTypeController@create');
        Route::post('update/{id}', 'JobTypeController@update');
        Route::post('delete/{id}', 'JobTypeController@delete');
    });
    // Location
    Route::prefix('location')->group(function () {
        Route::get('/', 'LocationController@index');
        Route::post('create', 'LocationController@create');
        Route::post('update/{id}', 'LocationController@update');
        Route::post('delete/{id}', 'LocationController@delete');
    });
    // Job
    Route::prefix('job')->group(function () {
        Route::get('/', 'JobController@index');
        Route::post('create', 'JobController@create');
        Route::post('update/{id}', 'JobController@update');
        Route::post('delete/{id}', 'JobController@delete');
    });
    // Skill
    Route::prefix('skill')->group(function () {
        Route::get('/', 'SkillController@index');
        Route::post('create', 'SkillController@create');
        Route::post('update/{id}', 'SkillController@update');
        Route::post('delete/{id}', 'SkillController@delete');
    });
    // Trait
    Route::prefix('trait')->group(function () {
        Route::get('/', 'TraitController@index');
        Route::post('create', 'TraitController@create');
        Route::post('update/{id}', 'TraitController@update');
        Route::post('delete/{id}', 'TraitController@delete');
    });


//    admin/ping
    Route::get('ping', function () {
        return response('pong', 200);

    });
});

