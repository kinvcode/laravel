<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::prefix('v1')->namespace('Api\v1')->group(function () {
    Route::get('version', 'IndexController@version');
    Route::post('auth/register', 'AuthController@register');
    Route::post('auth/login', 'AuthController@login');

    Route::middleware('auth:api')->group(function(){
        Route::post('auth/logout', 'AuthController@logout');
        Route::get('auth/me', 'AuthController@me');
    });
});
