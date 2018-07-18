<?php

namespace Tests;

use App\Models\User;
use Tests\Traits\AuthData;
use Illuminate\Foundation\Testing\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    use AuthData,
        CreatesApplication;

    public function setUp()
    {
        parent::setUp();

        $this->prepareAuth();
    }
}
