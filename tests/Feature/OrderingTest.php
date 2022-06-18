<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\Order;

class OrderingTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_order_drink_full_moon_created()
    {
        $this->withoutExceptionHandling();
        $response = $this->post('/api/drink/order',[
            'title' => 'Full Moon',
            'quantity' => 4,
            'price' => 2000,
        ]);
        $response->assertStatus(201);
        $orders = Order::all();
        $this->assertTrue(count($orders) > 0);
    }

    public function test_order_drink_deleted()
    {
        $this->withoutExceptionHandling();
        Order::factory()->times(5)->create();
        $id_to_be_deleted = random_int(1,5);
        $this->delete("/api/drink/$id_to_be_deleted");
        $this->assertDatabaseMissing('orders', ['id' => $id_to_be_deleted]);
    }
}
