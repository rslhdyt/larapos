<?php

namespace Tests\Feature;

use Carbon\Carbon;
use Tests\TestCase;
use App\Models\Supplier;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SupplierTest extends TestCase
{
    use RefreshDatabase;

    public function testIndex()
    {
        $suppliers = factory(Supplier::class, 5)->create();

        $response = $this->actingAs($this->authUser)
            ->get('suppliers');

        $response->assertStatus(200)
            ->assertViewHas('suppliers');
    }

    public function testTrash()
    {
        $suppliers = factory(Supplier::class, 5)->create(['deleted_at' => Carbon::now()]);

        $response = $this->actingAs($this->authUser)
            ->get('suppliers/trash');

        $response->assertStatus(200)
            ->assertViewHas('suppliers');
    }

    public function testCreate()
    {
        $response = $this->actingAs($this->authUser)
            ->get('suppliers/create');

        $response->assertStatus(200);
    }

    public function testStoreSuccess()
    {
        $data = factory(Supplier::class)->make()->toArray();

        $response = $this->actingAs($this->authUser)
            ->post('suppliers', $data);

        $response->assertStatus(302);
        
        $this->assertDatabaseHas('suppliers', [
            'name' => $data['name']
        ]);
    }

    public function testStoreValidationFailed()
    {
        $response = $this->actingAs($this->authUser)
            ->post('suppliers', []);

        $response->assertStatus(302)
            ->assertSessionHasErrors();
    }
    
    public function testShow()
    {
        $supplier = factory(Supplier::class)->create();

        $response = $this->actingAs($this->authUser)
            ->get('suppliers/' . $supplier->id);

        $response->assertStatus(200)
            ->assertViewHas('supplier');
    }

    public function testEdit()
    {
        $supplier = factory(Supplier::class)->create();

        $response = $this->actingAs($this->authUser)
            ->get('suppliers/' . $supplier->id . '/edit');

        $response->assertStatus(200)
            ->assertViewHas('supplier');
    }

    public function testUpdate()
    {
        $supplier = factory(Supplier::class)->create();
        $data = $supplier->toArray();
        $data['name'] = 'updated supplier';

        $response = $this->actingAs($this->authUser)
            ->put('suppliers/' . $supplier->id, $data);

        $response->assertStatus(302);

        $this->assertDatabaseHas('suppliers', [
            'name' => 'updated supplier'
        ]);
    }
}
