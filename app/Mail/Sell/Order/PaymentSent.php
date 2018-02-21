<?php

namespace App\Mail\Sell\Order;

use App\Model\Sell\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class PaymentSent extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Order instance for which the payment is being sent
     * @var Order
     */
    public $order;

    /**
     * Call to action button's informations
     * @var array
     */
    public $button;

    /**
     * Create a new message instance
     *            
     * @param Order $order Order instance that was just paid out
     * @return void
     */
    public function __construct(Order $order)
    {
        $this->order = $order;

        $this->button['url'] = $order->paymentShipping->tracking_url;
        $this->button['message'] = 'Track my Payment';
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->from(env('CONTACT_US_EMAIL'))
                    ->replyTo(env('CONTACT_US_EMAIL'))
                    ->markdown('mail.order.payment-sent')
                    ->subject('You\'ve got money coming your way!');
    }
}
