<?php

namespace Tests\Feature\Panel\Sell\Orders;

use Mail;
use App\User;
use App\Mail\Sell\Shipping\Label as BookShippingLabelEmail;
use App\Mail\Sell\Order\BookReceived as BookReceivedEmail;
use App\Mail\Sell\Order\PaymentSent as PaymentSentEmail;
use App\Model\Shipping\Label;
use App\Model\Sell\Order;
use App\Model\Sell\OrderStatus;
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

        // Set up mock emailing API
        Mail::fake();
    }
    
    /**
     * Test the ability to update an order's status
     */
    public function testCanUpdateOrderStatusAsReceived()
    {
    	// Given I have an admin, an order with its shipping label and an order status
        $order = factory(Order::class)->create();
        $label = factory(Label::class)->create([
            'order_id' => $order->id,
        ]);
        $status = factory(OrderStatus::class)->create([
            'code' => 'SHIPMENT_RECEIVED',
        ]);

    	// When the admin update the order's status
        $response = $this->actingAs($this->admin)
                        ->post('/admin/orders/update/received', [
                            'id' => $order->id,
                        ]);

    	// Then it should be updated and the user should be notified
        $response->assertSuccessful();
        $this->assertDatabaseHas('orders', [
            'id' => $order->id,
            'status_id' => $status->id,
        ]);

        $this->assertDatabaseMissing('orders', [
            'id' => $order->id,
            'received_at' => null,
        ]);

        Mail::assertSent(BookReceivedEmail::class, function($email) use ($order) {
            return $email->hasTo($order->user->email) &&
                    $email->order->id == $order->id;
        });
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
                        ->post('/admin/orders/update/paid', [
                            'id' => $order->id,
                            'amount' => $priceBought,
                        ]);

        // Then it should be updated and the user should be notified
        $response->assertSuccessful();
        $this->assertDatabaseHas('orders', [
            'id' => $order->id,
            'status_id' => $status->id,
            'payment_amount' => $priceBought,
        ]);

        $this->assertDatabaseMissing('orders', [
            'id' => $order->id,
            'paid_at' => null,
        ]);

        Mail::assertSent(PaymentSentEmail::class, function($email) use ($order) {
            return $email->hasTo($order->user->email) &&
                    $email->order->id == $order->id;
        });
    }

    /**
     * Test that an admin cannot update an order's status to paid out if the amount
     * is larger than 10,000
     */
    public function testCannotUpdateOrderStatusAsPaidWhenAmountIsTooLarge()
    {
        // Given I have an admin, an order, a new order status, and a an amount paid
        // for the book over 10,000
        $order = factory(Order::class)->create();
        $status = factory(OrderStatus::class)->create([
            'code' => 'PAYMENT_SENT',
        ]);
        $priceBought = 100001;

        // When the admin update the order's status
        $response = $this->actingAs($this->admin)
                        ->post('/admin/orders/update/paid', [
                            'id' => $order->id,
                            'amount' => $priceBought,
                        ]);

        // Then it should be fail validation and remain unchanged
        $response->assertStatus(302);
        $this->assertDatabaseMissing('orders', [
            'id' => $order->id,
            'status_id' => $status->id,
            'payment_amount' => $priceBought,
        ]);

        $this->assertDatabaseHas('orders', [
            'id' => $order->id,
            'paid_at' => null,
        ]);
    }
}
