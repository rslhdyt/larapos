<?php

namespace Tests;

use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ReceivingTest extends TestCase
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
            ->visit('inventories/receivings')
            ->seePageIs('inventories/receivings');
    }

    public function testCreate()
    {
        $this->actingAs($this->user)
            ->visit('inventories/receivings/create')
            ->seePageIs('inventories/receivings/create');
    }
}
