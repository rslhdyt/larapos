<?php

namespace Tests;

use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class SettingTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp()
    {
        parent::setUp();

        $this->user = factory(User::class)->make();
    }

    public function testEdit()
    {
        $this->actingAs($this->user)
            ->visit('settings/general')
            ->see('General Setting')
            ->seePageIs('settings/general');
    }
}
