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
        DB::table('oauth_access_tokens')->truncate();

        User::create([
            'name'     => 'Admin',
            'email'    => 'admin@example.com',
            'password' => '12345678',
        ])->createToken('Default');
    }
}
