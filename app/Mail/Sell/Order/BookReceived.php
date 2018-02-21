<?php

namespace App\Mail\Sell\Order;

use App\Model\Sell\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class BookReceived extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Order entry for the book that was received
     * @var \App\Model\Sell\Order
     */
    public $order;

    /**
     * Call to action button's informations
     * @var array
     */
    public $button;

    /**
     * Create a new message instance.
     * @param Order $order Order instance
     *
     * @return void
     */
    public function __construct(Order $order)
    {
        $this->order = $order;

        $this->button['url'] = $order->shippingLabel->tracking_url;
        $this->button['message'] = 'See my book\'s tracking history';
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
                    ->markdown('mail.order.book-received')
                    ->subject('We just received the textbook we\'re buying from you!');
    }
}
