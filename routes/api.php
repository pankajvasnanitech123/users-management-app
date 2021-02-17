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
Route::group(['namespace' => 'App\Http\Controllers\Api'], function() {
    Route::group(['prefix' => 'users'], function() {
        Route::post('create', 'UserController@create')->name('users.create');
        Route::get('show/{id}', 'UserController@show')->name('users.show');
        Route::put('update/{id}', 'UserController@update')->name('users.update');
        Route::post('delete/{id}', 'UserController@delete')->name('users.delete');
    });
});
