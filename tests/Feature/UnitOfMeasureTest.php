<?php

namespace Tests\Feature;

use Carbon\Carbon;
use Tests\TestCase;
use App\Models\UnitOfMeasure;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UnitOfMeasureTest extends TestCase
{
    use RefreshDatabase;

    public function testIndex()
    {
        $unitOfMeasures = factory(UnitOfMeasure::class, 5)->create();

        $response = $this->actingAs($this->authUser)
            ->get('unit-of-measures');

        $response->assertStatus(200)
            ->assertViewHas('unitOfMeasures');
    }

    public function testTrash()
    {
        $unitOfMeasures = factory(UnitOfMeasure::class, 5)->create(['deleted_at' => Carbon::now()]);

        $response = $this->actingAs($this->authUser)
            ->get('unit-of-measures/trash');

        $response->assertStatus(200)
            ->assertViewHas('unitOfMeasures');
    }

    public function testCreate()
    {
        $response = $this->actingAs($this->authUser)
            ->get('unit-of-measures/create');

        $response->assertStatus(200);
    }

    public function testStoreSuccess()
    {
        $data = factory(UnitOfMeasure::class)->make()->toArray();

        $response = $this->actingAs($this->authUser)
            ->post('unit-of-measures', $data);

        $response->assertStatus(302);
        
        $this->assertDatabaseHas('unit_of_measures', [
            'name' => $data['name']
        ]);
    }

    public function testStoreValidationFailed()
    {
        $response = $this->actingAs($this->authUser)
            ->post('unit-of-measures', []);

        $response->assertStatus(302)
            ->assertSessionHasErrors();
    }
    
    public function testShow()
    {
        $unitOfMeasure = factory(UnitOfMeasure::class)->create();

        $response = $this->actingAs($this->authUser)
            ->get('unit-of-measures/' . $unitOfMeasure->id);

        $response->assertStatus(200)
            ->assertViewHas('unitOfMeasure');
    }

    public function testEdit()
    {
        $unitOfMeasure = factory(UnitOfMeasure::class)->create();

        $response = $this->actingAs($this->authUser)
            ->get('unit-of-measures/' . $unitOfMeasure->id . '/edit');

        $response->assertStatus(200)
            ->assertViewHas('unitOfMeasure');
    }

    public function testUpdate()
    {
        $unitOfMeasure = factory(UnitOfMeasure::class)->create();
        $data = $unitOfMeasure->toArray();
        $data['name'] = 'updated unit of measures';

        $response = $this->actingAs($this->authUser)
            ->put('unit-of-measures/' . $unitOfMeasure->id, $data);

        $response->assertStatus(302);

        $this->assertDatabaseHas('unit_of_measures', [
            'name' => 'updated unit of measures'
        ]);
    }
}
