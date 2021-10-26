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

    // Skill Management
    Route::prefix('skill')->group(function () {
//        http://127.0.0.1:8000/admin/skill/
        Route::get('/', 'SkillController@getAllSkills');
        Route::post('/', 'SkillController@createSkill');
//        http://127.0.0.1:8000/admin/skill/1
        Route::put('/{id}', 'SkillController@updateSkill')->where('id',  '[0-9]+');
        Route::delete('/{id}', 'SkillController@deleteSkill')->where('id',  '[0-9]+');
    });

    Route::get('ping', function () {
        return response('pong', 200);

    });
});

