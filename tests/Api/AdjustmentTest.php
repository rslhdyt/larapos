<?php

namespace Tests\Api;

use App\Adjustment;
use App\AdjustmentItem;
use App\Product;
use App\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\AuthTestCase;

class AdjustmentTest extends AuthTestCase
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
        $user = factory(User::class)->create();
        $products = factory(Product::class, 10)->create();

        $adjustment_items = factory(AdjustmentItem::class, 2)->make();

        $adjustment = factory(Adjustment::class)->make([
            'id'      => rand(1, 10),
            'user_id' => $user->id,
            'items'   => $adjustment_items->toArray(),
        ])->toArray();

        $this->post('api/adjustments', $adjustment)->assertResponseStatus(201);
    }

    public function testStoreValidationFailed()
    {
        $products = factory(Product::class, 10)->create();

        $adjustment_items = factory(AdjustmentItem::class, 2)->make();

        $adjustment = factory(Adjustment::class)->make([
            'id'      => rand(1, 10),
            'user_id' => null,
            'items'   => null,
        ])->toArray();

        $response = $this->call('POST', 'api/adjustments', $adjustment);

        $this->post('api/adjustments', $adjustment)->assertResponseStatus(400);
    }
}
