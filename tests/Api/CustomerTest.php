<?php

namespace Tests\Api;

use App\Customer;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class CustomerTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testIndex()
    {
        $customers = factory(Customer::class, 10)->create();

        $this->get('api/customers')->assertResponseStatus(200);
    }
}
