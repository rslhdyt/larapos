<?php

namespace Tests\Model;

use App\Adjustment;
use App\Product;
use App\Supplier;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Tests\TestCase;

class AdjustmentModelTest extends TestCase
{
    use DatabaseMigrations;

    public $input_form;

    public function setUp()
    {
        parent::setUp();

        $this->input_form = [
            'user_id' => 1,
            'items'   => [
                ['product_id' => 1, 'adjustment' => 10, 'diff' => -10],
                ['product_id' => 2, 'adjustment' => 5, 'diff' => 5],
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
        $user = factory(User::class)->create();
        $supplier = factory(Supplier::class)->create();
        $products = factory(Product::class, 2)->create();

        $sales = Adjustment::createAll($this->input_form);

        // check tracking
        $this->seeInDatabase('inventory_trackings', [
            'product_id'     => 1,
            'user_id'        => 1,
            'trackable_type' => 'App\AdjustmentItem',
            'trackable_id'   => 1,
        ]);

        // check qty
        $this->seeInDatabase('products', [
            'id'       => 1,
            'quantity' => -10,
        ]);
    }
}
