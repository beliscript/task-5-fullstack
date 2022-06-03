<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::group([ 'namespace' => 'Web'], function() {
    Route::get('/', 'AuthController@index'); 
    Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
    Route::get('/kategori', 'CategoryController@index')->name('category');
    Route::get('/article', 'ArticleController@index')->name('article');
});