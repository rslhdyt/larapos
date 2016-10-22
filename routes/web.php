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
    return redirect('login');
});

Route::get('/home', 'HomeController@index');

Route::group(['middleware' => 'auth'], function () {
    Route::resource('customers', 'CustomerController');
    Route::resource('suppliers', 'SupplierController');
    Route::resource('products', 'ProductController');
    Route::resource('users', 'UserController');

    Route::resource('sales', 'SaleController', ['only' => ['create', 'store']]);

    Route::group(['prefix' => 'inventories'], function () {
        Route::resource('receivings', 'ReceivingController', ['except' => ['edit', 'update', 'destroy']]);
        Route::resource('adjustments', 'AdjustmentController', ['except' => ['edit', 'update', 'destroy']]);
        Route::get('trackings', 'TrackingController@index');
    });

    Route::get('reports/{type}', 'ReportController@index');
    Route::get('reports/{type}/{id}', 'ReportController@show');

    Route::group(['prefix' => 'settings'], function () {
        Route::get('profile', 'ProfileController@edit');
        Route::put('profile', 'ProfileController@update');
        Route::get('/personal-tokens', function () {
            return view('settings.users.personal-access-token');
        });
        Route::resource('roles', 'RoleController');
        Route::resource('permissions', 'PermissionController');
    });
});

Route::get('test', function() {
    $input_form = [
        'cashier_id' => 1,
        'customer_id' => 1,
        'items' => [
            [
                'product_id' => 1,
                'quantity'   => 1,
                'price'      => 100,
            ]
        ]
    ];

    // create object item
    $items = collect($input_form['items'])->map(function ($item) {
        return new App\SaleItem($item);
    });

    $sales = App\Sale::create($input_form);
    $sales->items()->saveMany($items);

    $trackings = $sales->items->each(function($item) use ($input_form) {
        $tracking = new App\InventoryTracking(['user_id' => $input_form['cashier_id']]);

        $item->trackings()->save($tracking);
    });
});
