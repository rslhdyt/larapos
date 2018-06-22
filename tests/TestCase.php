<?php

namespace Tests;

use App\Models\User;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use CreatesApplication;

    public $authUser;

    public function setUp()
    {
        parent::setUp();

        $this->authUser = factory(User::class)->create();
    }
}
