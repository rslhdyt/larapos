<?php

use Faker\Generator as Faker;

$factory->define(\App\Models\Receiving::class, function (Faker $faker) {
    return [
        'user_id' => 1,
        'supplier_id' => 1,
        'comments' => $faker->text,
    ];
});

$factory->define(\App\Models\ReceivingItem::class, function (Faker $faker) {
    return [
        'receiving_id' => 1,
        'product_id' => 1,
        'quantity' => $faker->randomDigit,
        'price' => $faker->randomDigit,
    ];
});
