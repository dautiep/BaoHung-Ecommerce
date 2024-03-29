<?php

use Illuminate\Support\Facades\Artisan;
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


Route::group([
    'namespace' => 'Frontend',
    'as' => 'frontend.'
], function () {
    Route::get('/', 'PageController@index')->name('index');
    Route::get('category/{slug?}', 'PageController@category')->name('category');
    Route::get('product/detail/{slug?}', 'PageController@productDetail')->name('product.detail');
    Route::get('contact', 'PageController@contact')->name('contact');
    Route::get('category_filter/ranger', 'PageController@categoryFilter')->name('category_filter');
    Route::get('services', 'PageController@serives')->name('service');
    Route::get('product/search', 'PageController@search')->name('search');
});
Route::group(['prefix' => 'admin', 'namespace' => 'Auth'], function () {
    Route::resource('login', 'LoginController');
    Route::get('logout', 'LoginController@logout')->name('logout');
    Route::any('resetPassword/{id?}', 'LoginController@resetPassword')->name('user.resetPassword');

    // Route::resource('reset-password', 'ResetPasswordController');
});

Route::group(['prefix' => 'admin', 'namespace' => 'Admin', 'middleware' => 'auth.admin'], function () {
    Route::get('/home', 'HomeController@index')->name('dashboard');
    Route::post('get-data-chart', 'HomeController@getDataChart')->name('dashboard.get.data.chart');

    // users
    // Route::group(['prefix' => 'users', 'as' => 'users.'], function () {
    //     Route::get('/', 'UserController@list')->name('list')->middleware('role:users.list');
    //     Route::get('create', 'UserController@create')->name('create');
    //     Route::post('/delete', 'UserController@delete')->name('delete');
    //     Route::get('edit/{id}', 'UserController@edit')->name('edit');
    //     Route::post('state', 'UserController@state')->name('state');
    //     Route::post('store/{id?}', 'UserController@store')->name('store');
    // });
    // roles
    // Route::group(['prefix' => 'roles', 'as' => 'roles.'], function () {
    //     Route::get('/', 'RoleController@list')->name('list');
    //     Route::get('create', 'RoleController@create')->name('create');
    //     Route::post('/delete', 'RoleController@delete')->name('delete');
    //     Route::get('edit/{id}', 'RoleController@edit')->name('edit');
    //     Route::post('store/{id?}', 'RoleController@store')->name('store');
    //     Route::get('config', 'RoleController@config')->name('config');
    // });

    // groups
    // Route::group(['prefix' => 'groups', 'as' => 'groups.'], function () {
    //     Route::get('/', 'GroupController@list')->name('list')->middleware('role:services.list');
    //     Route::get('create', 'GroupController@create')->name('create');
    //     Route::post('state', 'GroupController@state')->name('state');
    //     Route::post('/delete', 'GroupController@delete')->name('delete');
    //     Route::get('edit/{id}', 'GroupController@edit')->name('edit');
    //     Route::post('store/{id?}', 'GroupController@store')->name('store');
    // });

    //services
    Route::group(['prefix' => 'services', 'as' => 'services.'], function () {
        Route::get('', 'ServiceController@list')->name('list');
        Route::get('/create', 'ServiceController@create')->name('create');
        Route::post('/save/{id?}', 'ServiceController@save')->name('save');
        Route::get('/edit/{id}', 'ServiceController@edit')->name('edit');
        Route::post('/lock', 'ServiceController@lock')->name('lock');
        Route::post('/unlock', 'ServiceController@unlock')->name('unlock');
        Route::post('/upload-image', 'ProductController@uploadImage')->name('upload');

    });

    //questions
    Route::group(['prefix' => 'categories', 'as' => 'categories.'], function () {
        Route::get('', 'CategoryController@list')->name('list');
        Route::get('/create', 'CategoryController@create')->name('create');
        Route::post('/save/{id?}', 'CategoryController@save')->name('save');
        Route::get('/edit/{id}', 'CategoryController@edit')->name('edit');
        Route::post('/lock', 'CategoryController@lock')->name('lock');
        Route::post('/unlock', 'CategoryController@unlock')->name('unlock');
    });

    Route::group(['prefix' => 'products', 'as' => 'products.'], function () {
        Route::get('/', 'ProductController@list')->name('list');
        Route::get('/create','ProductController@create')->name('create');
        Route::post('/save/{id?}', 'ProductController@save')->name('save');
        Route::get('/edit/{id}', 'ProductController@edit')->name('edit');
        Route::post('/lock', 'ProductController@lock')->name('lock');
        Route::post('/unlock', 'ProductController@unlock')->name('unlock');
        Route::post('/remove', 'ProductController@remove')->name('remove');
        Route::post('/upload-image', 'ProductController@uploadImage')->name('upload-image');
    });

    // Route::group(['prefix' => 'department', 'as' => 'department.'], function () {
    //     Route::get('/', 'DepartmentController@index')->name('list');
    //     Route::get('/create', 'DepartmentController@create')->name('create');
    //     Route::get('/edit/{id}', 'DepartmentController@edit')->name('edit');
    //     Route::post('/store/{id?}', 'DepartmentController@store')->name('store');
    //     Route::post('state', 'DepartmentController@state')->name('state');
    // });
    Route::group(['prefix' => 'file_upload', 'as' => 'file_manager.'], function () {
        Route::post('upload', 'FileManagerController@fileUpload')->name('file_upload');
    });

    Route::group(['prefix' => 'config_cache', 'as' => 'config_cache.'], function () {
        Route::get('clear/cache', 'ConfigController@artisanCache')->name('artisanCache');
    });
    Route::group(['prefix' => 'config_banner', 'as' => 'config_banner.'], function () {
        Route::get('/', 'BannerController@index')->name('index');
        Route::get('/create', 'BannerController@create')->name('create');
        Route::get('/edit/{id}', 'BannerController@edit')->name('edit');
        Route::post('/store/{id?}', 'BannerController@store')->name('store');
        Route::post('/delete', 'BannerController@delete')->name('delete');
        Route::post('/status', 'BannerController@status')->name('status');

        Route::post('/upload-image', 'ProductController@uploadImage')->name('upload');


    });
    Route::group(['prefix' => 'filemanager'], function () {
        \UniSharp\LaravelFilemanager\Lfm::routes();
    });
});
