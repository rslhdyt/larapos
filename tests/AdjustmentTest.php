<?php

namespace Tests;

use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class AdjustmentTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp()
    {
        parent::setUp();

        $this->user = factory(User::class)->make();
    }

    public function testIndex()
    {
        $this->actingAs($this->user)
            ->visit('inventories/adjustments')
            ->seePageIs('inventories/adjustments');
    }

    public function testCreate()
    {
        $this->actingAs($this->user)
            ->visit('inventories/adjustments/create')
            ->seePageIs('inventories/adjustments/create');
    }
}
