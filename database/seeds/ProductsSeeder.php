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

        foreach ($this->products() as $key => $value) {
            Product::create([
                'barcode'     => $faker->randomNumber,
                'name'        => $value,
                'description' => $faker->text,
                'price'       => rand(1, 1000),
            ]);
        }
    }

    private function products()
    {
        return [
            'Nutela', 'Nu green tea', 'UC1000', 'Taro', 'Cheetoz', 'Peejoy', 'Nutrisari', 'Chimori', 'Milkita', 'Chitato', 'Malkis', 'Fanta', 'Coca cola', 'Sprite', 'Silverqueen', 'Indomie goreng', 'Indomie ayam bawang', 'Teh Tarik', 'Kopi kapal api', 'God day coffee', 'Kacang dua kelinci', 'Kacang Garuda', 'Gery salut', 'Mizone', 'Aqua', 'Kopiko', 'Pop mie',
        ];
    }
}
