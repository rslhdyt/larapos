<?php

namespace Tests\Api;

use App\Customer;
use App\Product;
use App\Sale;
use App\SaleItem;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\AuthTestCase;

class SaleTest extends AuthTestCase
{
    use DatabaseMigrations;
    use DatabaseTransactions;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testStoreSuccess()
    {
        $cashier = factory(User::class)->create();
        $customer = factory(Customer::class)->create();
        $products = factory(Product::class, 10)->create();

        $sale_items = factory(SaleItem::class, 2)->make();

        $sale = factory(Sale::class)->make([
            'id'          => rand(1, 10),
            'cashier_id'  => $cashier->id,
            'customer_id' => $customer->id,
            'items'       => $sale_items->toArray(),
        ])->toArray();

        $this->post('api/sales', $sale)->assertResponseStatus(201);
    }

    public function testStoreValidationFailed()
    {
        $products = factory(Product::class, 10)->create();

        $sale_items = factory(SaleItem::class, 2)->make();

        $sale = factory(Sale::class)->make([
            'id'          => rand(1, 10),
            'cashier_id'  => null,
            'customer_id' => null,
            'items'       => null,
        ])->toArray();

        $response = $this->call('POST', 'api/sales', $sale);

        $this->post('api/sales', $sale)->assertResponseStatus(400);
    }
}
