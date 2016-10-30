<?php

use App\Product;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        Product::truncate();

        foreach (range(0, 100) as $key => $value) { 
            Product::create([
                'barcode'     => $faker->randomNumber,
                'name'        => $faker->name,
                'description' => $faker->text,
                'price'       => rand(1, 1000),
            ]);
        }
    }
}
