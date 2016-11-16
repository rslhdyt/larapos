<?php

namespace Tests\Model;

use App\Customer;
use App\Product;
use App\Sale;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class SaleModelTest extends TestCase
{
    use DatabaseMigrations;

    public $input_form;

    public function setUp()
    {
        parent::setUp();

        $this->input_form = [
            'cashier_id'  => 1,
            'customer_id' => 1,
            'items'       => [
                ['product_id' => 1, 'quantity' => 10, 'price' => 100],
                ['product_id' => 2, 'quantity' => 5, 'price' => 150],
            ],
        ];
    }

    /**
     * A basic test example.
     *
     * @return void
     */
    public function testCreateAllSuccess()
    {
        $cashier = factory(User::class)->create();
        $customer = factory(Customer::class)->create();
        $products = factory(Product::class, 2)->create();

        $sales = Sale::createAll($this->input_form);

        // check tracking
        $this->seeInDatabase('inventory_trackings', [
            'product_id'     => 1,
            'user_id'        => 1,
            'trackable_type' => 'App\SaleItem',
            'trackable_id'   => 1,
        ]);

        // check qty
        $this->seeInDatabase('products', [
            'id'       => 1,
            'quantity' => -10,
        ]);
    }
}
