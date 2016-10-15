<?php

use Illuminate\Foundation\Testing\DatabaseMigrations;

class SaleTest extends TestCase
{
    use DatabaseMigrations;

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testStoreSuccess()
    {
        $cashier = factory(App\User::class)->create();
        $customer = factory(App\Customer::class)->create();

        $sale_items = factory(App\SaleItem::class, 2)->make();

        $sale = factory(App\Sale::class)->make([
            'cashier_id'  => $cashier->id,
            'customer_id' => $customer->id,
            'items'       => $sale_items->toArray(),
        ])->toArray();

        $response = $this->call('POST', 'api/sales', $sale);

        // test
        $this->assertEquals(201, $response->status());
    }

    public function testStoreValidationFailed()
    {
        $customer = factory(App\Customer::class)->create();

        $sale_items = factory(App\SaleItem::class, 2)->make();

        $sale = factory(App\Sale::class)->make([
            'cashier_id'  => null,
            'customer_id' => null,
            'items'       => null,
        ])->toArray();

        $response = $this->call('POST', 'api/sales', $sale);

        // test
        $this->assertEquals(400, $response->status());
        $this->assertArrayHasKey('errors', $response->getData(true));
    }
}
