<?php

namespace Tests\Api;

use App\Supplier;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class SupplierTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testIndex()
    {
        $suppliers = factory(Supplier::class, 10)->create();

        $this->get('api/suppliers')->assertResponseStatus(200);
    }
}
