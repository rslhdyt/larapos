<?php

namespace Tests\Feature;

use Carbon\Carbon;
use Tests\TestCase;
use App\Models\Product;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProductTest extends TestCase
{

    use RefreshDatabase;

    public function testIndex()
    {
        $products = factory(Product::class, 5)->create();

        $response = $this->actingAs($this->authUser)
            ->get('products');

        $response->assertStatus(200)
            ->assertViewHas('products');
    }

    public function testTrash()
    {
        $products = factory(Product::class, 5)->create(['deleted_at' => Carbon::now()]);

        $response = $this->actingAs($this->authUser)
            ->get('products/trash');

        $response->assertStatus(200)
            ->assertViewHas('products');
    }

    public function testCreate()
    {
        $response = $this->actingAs($this->authUser)
            ->get('products/create');

        $response->assertStatus(200)
            ->assertViewHas('unitOfMeasures');
    }

    public function testStoreSuccess()
    {
        $data = factory(Product::class)->make()->toArray();

        $response = $this->actingAs($this->authUser)
            ->post('products', $data);

        $response->assertStatus(302);
        
        $this->assertDatabaseHas('products', [
            'name' => $data['name']
        ]);
    }

    public function testStoreValidationFailed()
    {
        $response = $this->actingAs($this->authUser)
            ->post('products', []);

        $response->assertStatus(302)
            ->assertSessionHasErrors();
    }
    
    public function testShow()
    {
        $product = factory(Product::class)->create();

        $response = $this->actingAs($this->authUser)
            ->get('products/' . $product->id);

        $response->assertStatus(200)
            ->assertViewHas('product');
    }

    public function testEdit()
    {
        $product = factory(Product::class)->create();

        $response = $this->actingAs($this->authUser)
            ->get('products/' . $product->id . '/edit');

        $response->assertStatus(200)
            ->assertViewHas('product')
            ->assertViewHas('unitOfMeasures');
    }

    public function testUpdate()
    {
        $product = factory(Product::class)->create();
        $data = $product->toArray();
        $data['name'] = 'updated product';

        $response = $this->actingAs($this->authUser)
            ->put('products/' . $product->id, $data);

        $response->assertStatus(302);

        $this->assertDatabaseHas('products', [
            'name' => 'updated product'
        ]);
    }

    public function testDelete()
    {
        $product = factory(Product::class)->create();

        $response = $this->actingAs($this->authUser)
            ->delete('products/' . $product->id);

        $response->assertStatus(302);

        $this->assertDatabaseMissing('products', [
            'name' => $product->name,
            'deleted_at' => null,
        ]);
    }
}
