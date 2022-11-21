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

Route::group(['prefix' => 'admin', 'namespace' => 'Auth'], function() {
    Route::resource('login', 'LoginController');
    Route::get('logout', 'LoginController@logout')->name('logout');
    // Route::resource('reset-password', 'ResetPasswordController');
});

Route::group(['prefix' => 'admin', 'namespace' => 'Admin'], function() {
    Route::get('/home', 'HomeController@index')->name('dashboard');

    //services
    Route::group(['prefix' => 'services'], function() {
        Route::get('', 'TypeOfServiceController@list')->name('services.list');
        Route::get('/create', 'TypeOfServiceController@create')->name('services.create');
        Route::get('/store', 'TypeOfServiceController@store')->name('services.store');
        Route::post('/delete', 'TypeOfServiceController@delete')->name('services.delete');
    });

});
