<?php

use Faker\Generator as Faker;

$factory->define(\App\Models\Adjustment::class, function (Faker $faker) {
    return [
        'user_id' => 1,
        'comments' => $faker->text,
    ];
});

$factory->define(\App\Models\AdjustmentItem::class, function (Faker $faker) {
    return [
        'adjustment_id' => 1,
        'product_id' => 1,
        'adjustment' => $faker->randomDigit,
        'diff' => $faker->randomDigit,
    ];
});
