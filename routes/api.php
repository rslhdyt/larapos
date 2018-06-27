<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('products/search', 'ProductController@search')->name('products.search');
Route::delete('products/{product}', 'ProductController@destroy')->name('products.destroy');
Route::put('products/{product}/restore', 'ProductController@restore')->name('products.restore');

Route::get('suppliers/search', 'SupplierController@search')->name('suppliers.search');
Route::delete('suppliers/{supplier}', 'SupplierController@destroy')->name('suppliers.destroy');
Route::put('suppliers/{supplier}/restore', 'SupplierController@restore')->name('suppliers.restore');

Route::delete('customers/{customer}', 'CustomerController@destroy')->name('customers.destroy');
Route::put('customers/{customer}/restore', 'CustomerController@restore')->name('customers.restore');

Route::delete('unit-of-measures/{unit_of_measure}', 'UnitOfMeasureController@destroy')->name('unit-of-measures.destroy');
Route::put('unit-of-measures/{unit_of_measure}/restore', 'UnitOfMeasureController@restore')->name('unit-of-measures.restore');

Route::delete('users/{user}', 'UserController@destroy')->name('users.destroy');
Route::put('users/{user}/restore', 'UserController@restore')->name('users.restore');

Route::group(['middleware' => 'auth:api'], function () {
    Route::post('receivings', 'ReceivingController@store')->name('receivings.store');
    Route::post('adjustments', 'AdjustmentController@store')->name('adjustments.store');
});
