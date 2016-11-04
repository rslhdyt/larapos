<?php

use App\Setting;
use Illuminate\Database\Seeder;

class SettingsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Setting::truncate();

        Setting::create([
            'key'   => 'data_per_page',
            'label' => 'Data Perpage',
            'value' => 20,
        ]);
    }
}
