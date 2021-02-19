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

// Route::get('/', function () {
//     return view('welcome');
// });
Route::group(['namespace' => 'App\Http\Controllers\Admin'], function() {
    Route::get('login', 'LoginController@showLoginForm')->name('login');
    Route::post('login-validate', 'LoginController@validateLoginForm')->name('login_validate');

    Route::group(['middleware' => 'auth.admin'], function() {
        Route::get('dashboard', 'DashboardController@index')->name('dashboard');
        Route::get('logout', 'LoginController@logout')->name('logout');
    });
});
