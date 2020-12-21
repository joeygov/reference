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

Route::get('/', function () {
    return redirect()->route('login');
});

Route::namespace('App\Http\Controllers')->group(function () {
    Route::get('/login', 'AuthController@index')->name('login');
    Route::post('/login', 'AuthController@store');

    Route::middleware('auth:user')->group(function () {
        Route::get('/home', 'UserController@index')->name('home');
        Route::post('/logout', 'AuthController@logOut')->name('logout');

        Route::namespace('Admin')->prefix('admin')->group(function ()
        {
            Route::prefix('employee')->name('employee.')->group(function ()
            {
                Route::get('/list','EmployeeController@index')->name('list');
                Route::get('/search','EmployeeController@search')->name('search');
            });
        });
    });
});
