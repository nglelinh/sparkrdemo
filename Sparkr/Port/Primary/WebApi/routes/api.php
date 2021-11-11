<?php

use Illuminate\Support\Facades\Route;
use Sparkr\Port\Primary\WebApi\Controllers\Api\AccountController;
use Sparkr\Port\Primary\WebApi\Controllers\Api\FollowController;
use Sparkr\Port\Primary\WebApi\Controllers\Api\JobController;
use Sparkr\Port\Primary\WebApi\Controllers\Api\ResetPasswordController;
use Sparkr\Port\Primary\WebApi\Controllers\Api\SparkController;
use Sparkr\Port\Primary\WebApi\Controllers\Api\UserController;

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
    'namespace' => 'Sparkr\Port\Primary\WebApi\Controllers\Api',
    'middleware' => 'auth:api'
], function () {
    // User list view
    Route::prefix('user')->group(function () {
        Route::get('/', [UserController::class, 'userList']);
        Route::get('/basic-info/{userId}', [UserController::class, 'basicUserInfo']);
        Route::get('/search', [UserController::class, 'userSearch']);
        Route::get('/detail/{userId}', [UserController::class, 'userDetail']);
        Route::get('/similar/{userId}', [UserController::class, 'similarProfile']);
    });
    // Job
    Route::prefix('job')->group(function () {
        Route::post('/apply', [JobController::class, 'applyJob']);
        Route::post('/interested', [JobController::class, 'interestedJob']);
    });
    // Spark
    Route::prefix('spark')->group(function () {
        Route::post('/give-spark', [SparkController::class, 'giveSpark']);
        Route::post('/add-skill', [SparkController::class, 'addSkill']);
    });
    // Follow
    Route::post('/follow', [FollowController::class, 'follow']);
    Route::post('/unfollow', [FollowController::class, 'unfollow']);

    //    api/ping
    Route::get('ping', function () {
        return response('pong', 200);
    });
});

Route::post('login', [AccountController::class, 'login'])->name('login');
Route::post('register', [AccountController::class, 'register']);
Route::post('logout', [AccountController::class, 'logout']);
Route::post("refresh-token", [AccountController::class, 'refreshToken']);
Route::post('reset-password', [ResetPasswordController::class,'submitResetPassword']);
Route::get('reset-password', [ResetPasswordController::class,'resetPassword']);
Route::post('forgot-password', [ResetPasswordController::class,'sendMail']);

Route::group([
                 'middleware' => 'auth:api'
             ], function () {
    Route::get('me', [AccountController::class, 'user']);
});
