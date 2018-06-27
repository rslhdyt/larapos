<?php

namespace Tests\Feature;

use Carbon\Carbon;
use Tests\TestCase;
use App\Models\Adjustment;
use Illuminate\Foundation\Testing\RefreshDatabase;

class AdjustmentTest extends TestCase
{
    use RefreshDatabase;

    public function testIndex()
    {
        $adjustments = factory(Adjustment::class, 5)->create();

        $response = $this->actingAs($this->authUser)
            ->get('adjustments');

        $response->assertStatus(200)
            ->assertViewHas('adjustments');
    }

    public function testCreate()
    {
        $response = $this->actingAs($this->authUser)
            ->get('adjustments/create');

        $response->assertStatus(200);
    }

    // public function testStoreSuccess()
    // {
    //     $data = [
    //         'comments' => 'Test Adjusment',
    //         'items' => [
    //             ['product_id' => 1, 'adjustment' => 10, 'diff' => 0]
    //         ]
    //     ];

    //     $response = $this->actingAs($this->authUser)
    //         ->post('/api/adjustments', $data);

    //     $response->assertStatus(201);
        
    //     $this->assertDatabaseHas('adjustment', [
    //         'comments' => $data['comments'],
    //     ]);
    // }

    public function testShow()
    {
        $adjustment = factory(Adjustment::class)->create();

        $response = $this->actingAs($this->authUser)
            ->get('adjustments/' . $adjustment->id);

        $response->assertStatus(200)
            ->assertViewHas('adjustment');
    }

    public function testEdit()
    {
        $adjustment = factory(Adjustment::class)->create();

        $response = $this->actingAs($this->authUser)
            ->get('adjustments/' . $adjustment->id . '/edit');

        $response->assertStatus(200)
            ->assertViewHas('adjustment');
    }

    public function testPrint()
    {
        $adjustment = factory(Adjustment::class)->create();

        $response = $this->actingAs($this->authUser)
            ->get('adjustments/' . $adjustment->id . '/print');

        $response->assertStatus(200)
            ->assertViewHas('adjustment');
    }
}
