<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Supplier::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->email,
        'company_name' => $faker->name,
        'phone' => $faker->phoneNumber,
        'address' => $faker->address,
    ];
});
