<?php

namespace Tests;

use App\Product;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ProductTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp()
    {
        parent::setUp();

        $this->user = factory(User::class)->make();
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testSearchSuccess()
    {
        factory(Product::class)->create(['name' => 'Product Tests']);

        $input = [
            'q'  => 'Tests',
        ];

        $this->actingAs($this->user)
            ->visit('products')
            ->submitForm('Search', $input)
            ->see('Product Tests')
            ->seePageIs('products?q=Tests');
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testCreateSuccess()
    {
        $input = [
            'name'  => 'Product Tests',
            'price' => 1000,
        ];

        $this->actingAs($this->user)
            ->visit('products/create')
            ->submitForm('Save', $input)
            ->see('Product created!')
            ->seePageIs('products');
    }

    public function testCreateDuplicateProductName()
    {
        factory(Product::class)->create(['name' => 'Product Tests']);

        $input = [
            'name'  => 'Product Tests',
            'price' => 1000,
        ];

        $this->actingAs($this->user)
            ->visit('products/create')
            ->submitForm('Save', $input)
            ->see('The name has already been taken.')
            ->seePageIs('products/create');
    }

    public function testEditDataAvailable()
    {
        factory(Product::class)->create();

        $this->actingAs($this->user)
            ->visit('products/1/edit')
            ->see('Products - Edit');
    }

    public function testEditDataNotFound()
    {
        $this->actingAs($this->user)
            ->get('products/1/edit')
            ->assertResponseStatus(404);
    }

    public function testUpdateSuccess()
    {
        factory(Product::class)->create(['name' => 'Product Tests']);

        $input = [
            'name'  => 'Product Update Test',
            'price' => 1000,
        ];

        $this->actingAs($this->user)
            ->visit('products/1/edit')
            ->submitForm('Update', $input)
            ->see('Product updated!')
            ->seePageIs('products');
    }

    public function testDeleteSuccess()
    {
        factory(Product::class)->create(['name' => 'Product Tests']);

        $this->actingAs($this->user)
            ->visit('products')
            ->submitForm('Delete')
            ->see('Product deleted!')
            ->seePageIs('products');
    }
}
