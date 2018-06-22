<?php

namespace Tests\Feature;

use Carbon\Carbon;
use Tests\TestCase;
use App\Models\Customer;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CustomerTest extends TestCase
{
    use RefreshDatabase;

    public function testIndex()
    {
        $customers = factory(Customer::class, 5)->create();

        $response = $this->actingAs($this->authUser)
            ->get('customers');

        $response->assertStatus(200)
            ->assertViewHas('customers');
    }

    public function testTrash()
    {
        $customers = factory(Customer::class, 5)->create(['deleted_at' => Carbon::now()]);

        $response = $this->actingAs($this->authUser)
            ->get('customers/trash');

        $response->assertStatus(200)
            ->assertViewHas('customers');
    }

    public function testCreate()
    {
        $response = $this->actingAs($this->authUser)
            ->get('customers/create');

        $response->assertStatus(200);
    }

    public function testStoreSuccess()
    {
        $data = factory(Customer::class)->make()->toArray();

        $response = $this->actingAs($this->authUser)
            ->post('customers', $data);

        $response->assertStatus(302);
        
        $this->assertDatabaseHas('customers', [
            'name' => $data['name']
        ]);
    }

    public function testStoreValidationFailed()
    {
        $response = $this->actingAs($this->authUser)
            ->post('customers', []);

        $response->assertStatus(302)
            ->assertSessionHasErrors();
    }
    
    public function testShow()
    {
        $customer = factory(Customer::class)->create();

        $response = $this->actingAs($this->authUser)
            ->get('customers/' . $customer->id);

        $response->assertStatus(200)
            ->assertViewHas('customer');
    }

    public function testEdit()
    {
        $customer = factory(Customer::class)->create();

        $response = $this->actingAs($this->authUser)
            ->get('customers/' . $customer->id . '/edit');

        $response->assertStatus(200)
            ->assertViewHas('customer');
    }

    public function testUpdate()
    {
        $customer = factory(Customer::class)->create();
        $data = $customer->toArray();
        $data['name'] = 'updated customer';

        $response = $this->actingAs($this->authUser)
            ->put('customers/' . $customer->id, $data);

        $response->assertStatus(302);

        $this->assertDatabaseHas('customers', [
            'name' => 'updated customer'
        ]);
    }
}
