<?php

use Faker\Generator as Faker;

$factory->define(App\Models\Product::class, function (Faker $faker) {
    return [
        'barcode' => $faker->ean13,
        'name' => $faker->name,
        'description' => $faker->text,
        'uom_id' => $faker->randomDigit,
        'cost_price' => $faker->randomNumber(5),
        'unit_price' => $faker->randomNumber(5),
        'minimal_stock' => $faker->randomDigit,
    ];
});
