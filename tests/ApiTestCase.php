<?php

namespace Tests;

use App\Models\User;
use Laravel\Passport\Passport;

class ApiTestCase extends TestCase
{
    public function setUp()
    {
        parent::setUp();

        Passport::actingAs(
            factory(User::class)->create(),
            ['create-servers']
        );
    }
}
