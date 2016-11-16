<?php

namespace Tests;

use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class AuthTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp()
    {
        parent::setUp();

        $this->user = factory(User::class)->make();
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testRedirectIfAuthenticate()
    {
        $this->actingAs($this->user)
            ->visit('login')
            ->seePageIs('home');
    }
}
