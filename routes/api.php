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
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');

Route::group(['middleware' => 'auth:api'], function () {
    Route::post('sales', 'Api\SaleController@store');
    Route::post('receivings', 'Api\ReceivingController@store');
    Route::post('adjustments', 'Api\AdjustmentController@store');
});

Route::get('customers', 'Api\CustomerController@index');
Route::get('products', 'Api\ProductController@index');
Route::get('suppliers', 'Api\SupplierController@index');
