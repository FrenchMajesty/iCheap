<?php

namespace Tests\Feature\Panel\Desired\Orders;

use App\User;
use App\Desired\Order;
use App\Desired\OrderStatus;
use Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;

class UpdateOrdersTest extends TestCase
{
	use DatabaseTransactions;
    
    private $admin;

    /**
     * Set up test case
     */
    public function setUp()
    {
    	parent::setUp();

		$this->admin = factory(User::class)->create([
            'account' => 'admin',
            'rank' => 2,
        ]);    	
    }
    
    /**
     * Test the ability to update an order's status
     */
    public function testCanUpdateOrderStatusAsReceived()
    {
    	// Given I have an admin some order and a new order status
        $order = factory(Order::class)->create();
        $status = factory(OrderStatus::class)->create([
            'code' => 'SHIPMENT_RECEIVED',
        ]);

    	// When the admin update the order's status
        $response = $this->actingAs($this->admin)
                        ->post('/admin/orders/update', [
                            'id' => $order->id,
                            'status' => $status->code,
                        ]);

    	// Then it should be updated
        $response->assertSuccessful();
        $this->assertDatabaseHas('orders', [
            'id' => $order->id,
            'status_id' => $status->id,
        ]);

        $this->assertDatabaseMissing('orders', [
            'id' => $order->id,
            'received_at' => null,
        ]);
    }

    /**
     * Test the ability to update an order's status
     */
    public function testCanUpdateOrderStatusAsPaid()
    {
        // Given I have an admin some order and a new order status
        $order = factory(Order::class)->create();
        $status = factory(OrderStatus::class)->create([
            'code' => 'PAYMENT_SENT',
        ]);
        $priceBought = 50.95;

        // When the admin update the order's status
        $response = $this->actingAs($this->admin)
                        ->post('/admin/orders/update', [
                            'id' => $order->id,
                            'status' => $status->code,
                            'amount' => $priceBought,
                        ]);

        // Then it should be updated
        $response->assertSuccessful();
        $this->assertDatabaseHas('orders', [
            'id' => $order->id,
            'status_id' => $status->id,
            'payment_amount' => $priceBought,
        ]);

        $this->assertDatabaseMissing('orders', [
            'id' => $order->id,
            'deleted_at' => null,
        ]);
    }

    /**
     * Test that an admin cannot update an order's status if the order
     * doesn't exist
     */
    public function testCannotUpdateOrderStatusOnOrderThatDoesntExist()
    {
        // Given I have an admin an order that no longer exists and 
        // a new order status
        $order = factory(Order::class)->create();
        $status = factory(OrderStatus::class)->create();
        Order::destroy($order->id);

        // When the admin update the order's status
        $response = $this->actingAs($this->admin)
                        ->post('/admin/orders/update', [
                            'id' => $order->id,
                            'status' => $status->code,
                        ]);

        // Then it should fail validation
        $response->assertStatus(302);
    }

    /**
     * Test that an admin cannot update an order's status if the new
     * status is invalid
     */
    public function testCannotUpdateOrderStatusWhenNewStatusIsNotValid()
    {
        // Given I have an admin some order and an new order status
        // that no longer exists
        $order = factory(Order::class)->create();
        $status = factory(OrderStatus::class)->create();
        OrderStatus::destroy($status->id);

        // When the admin update the order's status
        $response = $this->actingAs($this->admin)
                        ->post('/admin/orders/update', [
                            'id' => $order->id,
                            'status' => $status->code,
                        ]);

        // Then it should fail validation and remain unchanged
        $response->assertStatus(302);
        $this->assertDatabaseMissing('orders', [
            'id' => $order->id,
            'status_id' => $status->id,
        ]);
    }

    /**
     * Test that an admin cannot update an order's status if the tracking
     * ID is too long
     */
    public function testCannotUpdateOrderStatusWhenTrackingIDIsTooLong()
    {
        // Given I have an admin some order, a new order status and 
        // a tracking ID over 50 char. long
        $order = factory(Order::class)->create();
        $status = factory(OrderStatus::class)->create();
        $trackingNumber = str_repeat('a', 51);

        // When the admin update the order's status
        $response = $this->actingAs($this->admin)
                        ->post('/admin/orders/update', [
                            'id' => $order->id,
                            'status' => $status->code,
                            'tracking' => $trackingNumber,
                        ]);

        // Then it should fail validation and remain unchanged
        $response->assertStatus(302);
        $this->assertDatabaseMissing('orders', [
            'id' => $order->id,
            'status_id' => $status->id,
        ]);
    }
}
