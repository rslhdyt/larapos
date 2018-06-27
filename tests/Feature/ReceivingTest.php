<?php

namespace Tests\Feature;

use Carbon\Carbon;
use Tests\TestCase;
use App\Models\Receiving;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ReceivingTest extends TestCase
{
    use RefreshDatabase;

    public function testIndex()
    {
        $receivings = factory(Receiving::class, 5)->create();

        $response = $this->actingAs($this->authUser)
            ->get('receivings');

        $response->assertStatus(200)
            ->assertViewHas('receivings');
    }

    public function testCreate()
    {
        $response = $this->actingAs($this->authUser)
            ->get('receivings/create');

        $response->assertStatus(200);
    }

    public function testShow()
    {
        $receiving = factory(Receiving::class)->create();

        $response = $this->actingAs($this->authUser)
            ->get('receivings/' . $receiving->id);

        $response->assertStatus(200)
            ->assertViewHas('receiving');
    }

    public function testEdit()
    {
        $receiving = factory(Receiving::class)->create();

        $response = $this->actingAs($this->authUser)
            ->get('receivings/' . $receiving->id . '/edit');

        $response->assertStatus(200)
            ->assertViewHas('receiving');
    }

    public function testPrint()
    {
        $receiving = factory(Receiving::class)->create();

        $response = $this->actingAs($this->authUser)
            ->get('receivings/' . $receiving->id . '/print');

        $response->assertStatus(200)
            ->assertViewHas('receiving');
    }
}
