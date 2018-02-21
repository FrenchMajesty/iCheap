<?php

namespace App\Mail\Sell\Shipping;

use App\Model\Sell\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class Label extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Model instance for the order for which this label is for
     * @var \App\Model\Sell\Order
     */
    public $order;

    public $button;

    /**
     * Create a new message instance.
     * @param \App\Model\Sell\Order $order Order instance
     *
     * @return void
     */
    public function __construct(Order $order)
    {
        $this->order = $order;

        $this->button['url'] = $order->shippingLabel->label_url;
        $this->button['message'] = 'Get FREE your label now!';
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
                    ->markdown('mail.sell.shipping-label')
                    ->subject('Your book\'s FREE shipping label and the Tracking Number');
    }
}
