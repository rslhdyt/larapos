<?php

namespace Tests\Api;

use App\Product;
use App\Receiving;
use App\ReceivingItem;
use App\Supplier;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\AuthTestCase;

class ReceivingTest extends AuthTestCase
{
    use DatabaseMigrations;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testStoreSuccess()
    {
        $user = factory(User::class)->create();
        $products = factory(Product::class, 10)->create();
        $supplier = factory(Supplier::class)->create();

        $receiving_items = factory(ReceivingItem::class, 2)->make();

        $receiving = factory(Receiving::class)->make([
            'id'          => rand(1, 10),
            'supplier_id' => $supplier->id,
            'user_id'     => $user->id,
            'items'       => $receiving_items->toArray(),
        ])->toArray();

        $this->post('api/receivings', $receiving)->assertResponseStatus(201);
    }

    public function testStoreValidationFailed()
    {
        $products = factory(Product::class, 10)->create();

        $receiving_items = factory(ReceivingItem::class, 2)->make();

        $receiving = factory(Receiving::class)->make([
            'id'          => rand(1, 10),
            'supplier_id' => null,
            'user_id'     => null,
            'items'       => null,
        ])->toArray();

        $response = $this->call('POST', 'api/receivings', $receiving);

        $this->post('api/receivings', $receiving)->assertResponseStatus(400);
    }
}
