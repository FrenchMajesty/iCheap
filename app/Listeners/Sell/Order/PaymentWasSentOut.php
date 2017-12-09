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
        Payment::create([
            'order_id' => $event->order->id,
            'shippo_object_id' => $event->label['shipment_object_id'],
            'label_url' => $event->label['label_url'],
            'tracking_url' => $event->label['tracking_url_provider'],
            'tracking_number' => $event->label['tracking_number'],
        ]);

        $recipient = $event->order->user;
        Mail::to($recipient)->send(new PaymentSentEmail($event->order));
    }
}
