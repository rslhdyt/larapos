<?php

namespace Tests;

use App\Customer;
use App\Product;
use App\Sale;
use App\SaleItem;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class SaleTest extends TestCase
{
    use DatabaseMigrations;

    public function setUp()
    {
        parent::setUp();

        $this->user = factory(User::class)->make();
    }

    public function testCreate()
    {
        $this->actingAs($this->user)
            ->visit('sales/create')
            ->seePageIs('sales/create');
    }

    public function testReceipt()
    {
        $cashier = factory(User::class)->create();
        $customer = factory(Customer::class)->create();
        $products = factory(Product::class, 10)->create();

        $sale = factory(Sale::class)->create([
            'cashier_id'  => $cashier->id,
            'customer_id' => $customer->id,
        ]);
        $sale_items = factory(SaleItem::class, 2)->create([
            'sale_id' => $sale->id,
        ]);

        $this->actingAs($this->user)
            ->visit('sales/receipt/'.$sale->id)
            ->assertResponseStatus(200);
    }
}
