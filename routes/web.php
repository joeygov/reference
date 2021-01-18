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

    Route::get('/entry_page', 'EntryPageController@entryPage')->name('entryPage');
    Route::post('/captureImage', 'EntryPageController@saveImage')->name('capture_Image');
    Route::get('/fingerprint', 'EntryPageController@fingerprint')->name('fingerprint');

    Route::middleware('auth:user')->group(function () {
        Route::get('/home/{response?}', 'UserController@index')->name('home');
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

        Route::prefix('user')->name('user.')->group(function () {
            Route::get('/profile', 'UserController@profile')->name('profile');
            Route::get('/tracker', 'TrackerController@index')->name('tracker');
            Route::get('/tracker/search', 'TrackerController@search')->name('tracker.search');
            Route::get('/calendartracker', 'TrackerController@calendar')->name('calendartracker');
        });

        Route::namespace('Admin')->prefix('admin')->group(function () {
            Route::prefix('employee')->name('employee.')->group(function () {
                Route::get('/list', 'EmployeeController@index')->name('list');
                Route::get('/search', 'EmployeeController@search')->name('search');
                Route::get('/add', 'EmployeeController@create')->name('create');
                Route::get('/edit/{employee}', 'EmployeeController@edit')->name('edit');
                Route::get('/delete/{employee}', 'EmployeeController@destroy')->name('destroy');
                Route::post('/store', 'EmployeeController@store')->name('store');
                Route::post('/image', 'EmployeeController@updateImage');
                Route::post('/update/{employee}', 'EmployeeController@update')->name('update');
            });

            Route::prefix('account')->name('account.')->group(function () {
                Route::get('/list', 'AccountController@index')->name('list');
                Route::get('/add', 'AccountController@create')->name('create');
                Route::get('/search', 'AccountController@search')->name('search');
                Route::get('/edit/{account}', 'AccountController@edit')->name('edit');
                Route::get('/delete/{account}', 'AccountController@destroy')->name('delete');
                Route::post('/store', 'AccountController@store')->name('store');
                Route::post('/update/{account}', 'AccountController@update')->name('update');
            });

            Route::prefix('schedule')->name('schedule.')->group(function () {
                Route::get('/list', 'ScheduleController@index')->name('list');
                Route::get('/search', 'ScheduleController@search')->name('search');
                Route::get('/add', 'ScheduleController@create')->name('create');
                Route::get('/getEmployee', 'ScheduleController@getEmployee')->name('getEmployee');
                Route::get('/edit/{schedule}', 'ScheduleController@edit')->name('edit');
                Route::get('/delete/{schedule}', 'ScheduleController@destroy')->name('delete');
                Route::post('/store', 'ScheduleController@store')->name('store');
                Route::post('/update/{schedule}', 'ScheduleController@update')->name('update');
            });

            Route::prefix('attendance')->name('attendance.')->group(function () {
                Route::get('/list', 'AttendanceController@index')->name('list');
                Route::get('/search', 'AttendanceController@search')->name('search');
            });

            Route::prefix('overbreak')->name('overbreak.')->group(function () {
                Route::get('/list', 'OverBreakController@index')->name('list');
                Route::get('/search', 'OverBreakController@search')->name('search');
                Route::get('/add', 'OverBreakController@create')->name('create');
                Route::get('/edit/{overbreak}', 'OverBreakController@edit')->name('edit');
                Route::get('/delete/{overbreak}', 'OverBreakController@destroy')->name('delete');
                Route::post('/store', 'OverBreakController@store')->name('store');
                Route::post('/update/{overbreak}', 'OverBreakController@update')->name('update');
            });
        });
    });
});
