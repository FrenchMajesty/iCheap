<?php

namespace App\Listeners\Sell\Order;

use Mail;
use App\Model\Shipping\Payment;
use App\Mail\Sell\Order\PaymentSent as PaymentSentEmail;
use App\Events\Sell\Order\PaymentSent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class PaymentWasSentOut
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  PaymentSent  $event
     * @return void
     */
    public function handle(PaymentSent $event)
    {
        $recipient = $event->order->user;
        Mail::to($recipient)->send(new PaymentSentEmail($event->order));
    }
}
