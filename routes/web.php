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

    Route::get('/entry_page', 'EntryPageController@entryPage')->name('entry_page');
    Route::post('/get_emp', 'EntryPageController@getEmployee');;
    Route::get('/fingerprint', 'EntryPageController@fingerprint')->name('fingerprint');
    Route::post('/entrytimeIn', 'EntryPageController@timeInOut')->name('entrytimeinout');
    Route::get('/info', 'EntryPageController@getInfo')->name('getInfo');


    Route::middleware('auth:user')->group(function () {
        Route::get('/home', 'UserController@index')->name('home');
        Route::post('/wfhtimeIn', 'UserController@timeIn')->name('wfhtimein');
        Route::post('/b1start', 'UserController@setB1Start')->name('b1start');
        Route::post('/b1end', 'UserController@setB1End')->name('b1end');
        Route::post('/b2start', 'UserController@setB2Start')->name('b2start');
        Route::post('/b2end', 'UserController@setB2End')->name('b2end');
        Route::post('/b3start', 'UserController@setB3Start')->name('b3start');
        Route::post('/b3end', 'UserController@setB3End')->name('b3end');
        Route::post('/b4start', 'UserController@setB4Start')->name('b4start');
        Route::post('/b4end', 'UserController@setB4End')->name('b4end');
        Route::post('/wfhtimeOut', 'UserController@timeOut')->name('wfhtimeout');

        Route::post('/logout', 'AuthController@logOut')->name('logout');

        Route::namespace('Admin')->prefix('admin')->group(function ()
        {
            Route::prefix('employee')->name('employee.')->group(function ()
            {
                Route::get('/list','EmployeeController@index')->name('list');
                Route::get('/search','EmployeeController@search')->name('search');
            });
        });

        Route::namespace('ReportManager')->prefix('manager')->group(function () {
            Route::prefix('attendance')->name('attendance.')->group(function () {
                Route::get('/list', 'AttendanceController@index')->name('list');
                Route::get('/search', 'AttendanceController@search')->name('search');
            });
        });
    });
});
