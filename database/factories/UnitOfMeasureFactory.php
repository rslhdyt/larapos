<?php

use Faker\Generator as Faker;

$factory->define(App\Models\UnitOfMeasure::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'abbreviation' => strtoupper($faker->name),
        'description' => $faker->text,
    ];
});
