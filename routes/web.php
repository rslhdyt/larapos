<?php

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

Auth::routes();

Route::group(['middleware' => 'auth'], function () {
    Route::get('dashboard', 'DashboardController@index')->name('dashboard.index');

    Route::get('products/trash', 'ProductController@trash')->name('products.trash');
    Route::get('products/export', 'ProductController@export')->name('products.export');
    Route::resource('products', 'ProductController');

    Route::get('suppliers/trash', 'SupplierController@trash')->name('suppliers.trash');
    Route::get('suppliers/export', 'SupplierController@export')->name('suppliers.export');
    Route::resource('suppliers', 'SupplierController');
    
    Route::get('customers/trash', 'CustomerController@trash')->name('customers.trash');
    Route::get('customers/export', 'CustomerController@export')->name('customers.export');
    Route::resource('customers', 'CustomerController');
    
    Route::resource('sales', 'ProductController');
    Route::resource('receivings', 'ProductController');
    Route::resource('adjustments', 'ProductController');
    Route::resource('unit-of-measures', 'ProductController');

    Route::resource('users', 'ProductController');
    Route::get('settings', 'ProductController@index')->name('settings.edit');
});
