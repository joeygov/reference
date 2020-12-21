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
    Route::post('/login', 'LoginController@store');

    Route::get('/entry_page', 'EntryPageController@entryPage')->name('entryPage');
    Route::post('/captureImage', 'EntryPageController@saveImage')->name('capture_Image');
    Route::get('/fingerprint', 'EntryPageController@fingerprint')->name('fingerprint');
    Route::post('/login', 'AuthController@store');

    Route::middleware('auth:user')->group(function () {
        Route::get('/home', 'UserController@index')->name('home');
        Route::post('/logout', 'AuthController@logOut')->name('logout');
    });
});

