<?php

use App\Supplier;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class SuppliersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        Supplier::truncate();

        foreach (range(0, 100) as $key => $value) {
            Supplier::create([
                'name'         => $faker->name,
                'company_name' => $faker->name,
                'email'        => $faker->email,
                'phone'        => $faker->phoneNumber,
                'address'      => $faker->address,
            ]);
        }
    }
}
