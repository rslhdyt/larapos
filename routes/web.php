<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Auth::routes();

Route::get('/', function () {
    return view('welcome');
});

Route::get('/home', 'HomeController@index');

Route::group(['middleware' => 'auth'], function(){
    Route::resource('customers', 'CustomerController');
    Route::resource('suppliers', 'SupplierController');
    Route::resource('products', 'ProductController');
    Route::resource('users', 'UserController');

    Route::group(['prefix' => 'settings'], function(){
        Route::get('/', 'RoleController@index');
        Route::resource('roles', 'RoleController');
        Route::resource('permissions', 'PermissionController');
    });
});

