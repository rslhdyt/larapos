<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name'           => $faker->name,
        'email'          => $faker->safeEmail,
        'password'       => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Product::class, function (Faker\Generator $faker) {
    return [
        'barcode'     => $faker->ean13,
        'name'        => $faker->name,
        'description' => $faker->text,
        'price'       => $faker->randomNumber(5),
    ];
});

$factory->define(App\Customer::class, function (Faker\Generator $faker) {
    return [
        'name'    => $faker->name,
        'email'   => $faker->safeEmail,
        'phone'   => $faker->phoneNumber,
        'address' => $faker->address,
    ];
});

$factory->define(App\Supplier::class, function (Faker\Generator $faker) {
    return [
        'name'         => $faker->name,
        'company_name' => $faker->name,
        'email'        => $faker->safeEmail,
        'phone'        => $faker->phoneNumber,
        'address'      => $faker->address,
    ];
});

$factory->define(App\Permission::class, function () {
    $objects = ['product', 'customer'];
    $actions = ['index', 'create', 'edit', 'destroy'];

    return [
        'object' => $objects[rand(0, 1)],
        'action' => $actions[rand(0, 3)],
    ];
});

$factory->define(App\Role::class, function (Faker\Generator $faker) {
    return [
        'name'        => $faker->name,
        'description' => $faker->text(140),
    ];
});

$factory->define(App\Sale::class, function (Faker\Generator $faker) {
    return [
        'customer_id' => rand(1, 9),
        'cashier_id'  => rand(1, 9),
    ];
});

$factory->define(App\SaleItem::class, function (Faker\Generator $faker) {
    return [
        'product_id' => rand(1, 9),
        'price'      => rand(100, 999),
        'quantity'   => rand(1, 99),
    ];
});

$factory->define(App\Adjustment::class, function (Faker\Generator $faker) {
    return [
        'user_id'  => rand(1, 9),
    ];
});

$factory->define(App\AdjustmentItem::class, function (Faker\Generator $faker) {
    return [
        'product_id' => rand(1, 9),
        'adjustment' => rand(100, 999),
        'diff'       => rand(1, 99),
    ];
});

$factory->define(App\Receiving::class, function (Faker\Generator $faker) {
    return [
        'user_id'  => rand(1, 9),
    ];
});

$factory->define(App\ReceivingItem::class, function (Faker\Generator $faker) {
    return [
        'product_id' => rand(1, 9),
        'price'      => rand(100, 999),
        'quantity'   => rand(1, 99),
    ];
});
