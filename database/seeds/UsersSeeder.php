<?php

use App\User;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();

        User::create([
            'name'     => 'Admin',
            'email'    => 'admin@example.com',
            'password' => bcrypt('12345678'),
        ]);
    }
}
