<?php

use App\Customer;
use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class CustomersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();

        Customer::truncate();

        foreach (range(0, 100) as $key => $value) {
            Customer::create([
                'name'      => $faker->name,
                'email'     => $faker->email,
                'phone'     => $faker->phoneNumber,
                'address'   => $faker->address,
            ]);
        }
    }
}
