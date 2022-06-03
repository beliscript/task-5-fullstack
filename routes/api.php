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


Route::group(['prefix' => 'v1', 'namespace' => 'API'], function() {
    Route::post('register', 'PassportAuthController@register');
    Route::post('login', 'PassportAuthController@login');
    Route::group(['middleware' => 'auth:api'], function() {
        Route::post('logout', 'PassportAuthController@logout')->name('api.logout');
        Route::get('user', 'PassportAuthController@userInfo');
        Route::get('dashboard', 'DashboardController@index')->name('api.dashboard');
        Route::resource('categories', CategoryController::class);
        Route::resource('articles', ArticleController::class);
    });
});