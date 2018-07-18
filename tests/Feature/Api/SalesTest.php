<?php

namespace Tests\Feature\Api;

use App\Models\Sales;
use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class SalesTest extends TestCase
{
    use RefreshDatabase;

    public function testStoreSuccess()
    {
        $data = [
            'comments' => 'Test Sales',
            'items' => [
                ['product_id' => 1, 'quantity' => 10, 'price' => 10, 'discount' => 0]
            ],
            'payments' => [
                ['payment_method_id' => 1, 'amount' => 100]
            ]
        ];

        $response = $this->post('/api/sales', $data);

        $response->assertStatus(201);
        
        $this->assertDatabaseHas('sales', [
            'comments' => $data['comments'],
        ]);
    }
}
