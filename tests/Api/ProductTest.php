<?php

namespace Tests\Api;

use App\Product;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class ProductTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testIndex()
    {
        $products = factory(Product::class, 10)->create();

        $this->get('api/products')->assertResponseStatus(200);
    }
}
