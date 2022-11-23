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
        Route::post('/delete', 'TypeOfServiceController@delete')->name('services.delete');
    });
    // users
    Route::group(['prefix' => 'users', 'as' => 'users.'], function () {
        Route::get('/', 'UserController@list')->name('list');
        Route::get('create', 'UserController@create')->name('create');
        Route::post('/delete', 'UserController@delete')->name('delete');
        Route::get('edit/{id}', 'UserController@edit')->name('edit');
        Route::post('store/{id?}', 'UserController@store')->name('store');
    });
    // roles
    Route::group(['prefix' => 'roles', 'as' => 'roles.'], function () {
        Route::get('/', 'RoleController@list')->name('list');
        Route::get('create', 'RoleController@create')->name('create');
        Route::post('/delete', 'RoleController@delete')->name('delete');
        Route::get('edit/{id}', 'RoleController@edit')->name('edit');
        Route::post('store/{id?}', 'RoleController@store')->name('store');
        Route::get('config', 'RoleController@config')->name('config');
    });

    // groups
    Route::group(['prefix' => 'groups', 'as' => 'groups.'], function () {
        Route::get('/', 'GroupController@list')->name('list');
    });
});
