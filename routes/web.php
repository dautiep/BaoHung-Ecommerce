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

Route::group(['prefix' => 'admin', 'namespace' => 'Auth'], function () {
    Route::resource('login', 'LoginController');
    Route::get('logout', 'LoginController@logout')->name('logout');
    // Route::resource('reset-password', 'ResetPasswordController');
});

Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function () {
    Route::get('/home', 'HomeController@index')->name('dashboard');

    //services
    Route::group(['prefix' => 'services'], function () {
        Route::get('', 'TypeOfServiceController@list')->name('services.list');
        Route::get('/create', 'TypeOfServiceController@create')->name('services.create');
        Route::post('/store/{id?}', 'TypeOfServiceController@store')->name('services.store');
        Route::get('/edit/{id}', 'TypeOfServiceController@edit')->name('services.edit');
        Route::post('/lock', 'TypeOfServiceController@lock')->name('services.lock');
        Route::post('/unlock', 'TypeOfServiceController@unlock')->name('services.unlock');
    });
    // users
    Route::group(['prefix' => 'users', 'as' => 'users.'], function () {
        Route::get('/', 'UserController@list')->name('list');
        Route::get('create', 'UserController@create')->name('create');
        Route::post('/delete', 'UserController@delete')->name('delete');
        Route::get('edit/{id}', 'UserController@edit')->name('edit');
        Route::post('store/{id?}', 'UserController@store')->name('store');
    });
});
