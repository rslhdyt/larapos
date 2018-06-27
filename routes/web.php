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
    
    Route::get('unit-of-measures/trash', 'UnitOfMeasureController@trash')->name('unit-of-measures.trash');
    Route::get('unit-of-measures/export', 'UnitOfMeasureController@export')->name('unit-of-measures.export');
    Route::resource('unit-of-measures', 'UnitOfMeasureController');

    Route::resource('sales', 'ProductController');

    Route::get('users/trash', 'UserController@trash')->name('users.trash');
    Route::get('users/export', 'UserController@export')->name('users.export');
    Route::resource('users', 'UserController');

    Route::get('receivings/{receiving}/print', 'ReceivingController@print')->name('receivings.print');
    Route::get('receivings/export', 'ReceivingController@export')->name('receivings.export');
    Route::resource('receivings', 'ReceivingController');
    
    Route::get('adjustments/{adjustment}/print', 'AdjustmentController@print')->name('adjustments.print');
    Route::get('adjustments/export', 'AdjustmentController@export')->name('adjustments.export');
    Route::resource('adjustments', 'AdjustmentController');

    Route::get('settings', 'ProductController@index')->name('settings.edit');
});
