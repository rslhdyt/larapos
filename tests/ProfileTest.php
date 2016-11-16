<?php

namespace Tests;

use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class ProfileTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp()
    {
        parent::setUp();

        $this->user = factory(User::class)->make([
            'name' => 'Admin Larapos',
        ]);
    }

    public function testEdit()
    {
        $this->actingAs($this->user)
            ->visit('settings/profile')
            ->see('Admin Larapos')
            ->seePageIs('settings/profile');
    }

    public function testUpdateSuccess()
    {
        $this->actingAs($this->user)
            ->visit('settings/profile')
            ->submitForm('Update', ['name' => 'Admin Larapos 2'])
            ->see('Profile updated!')
            ->seePageIs('settings/profile');
    }
}
