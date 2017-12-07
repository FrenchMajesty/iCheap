<?php

namespace App\Listeners\Sell\Shipping;

use Mail;
use App\Mail\Sell\Shipping\Label;
use App\Events\Sell\Shipping\GenerateOrderLabel;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class LabelWasGenerated
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
     * Handle the event and send the label and order informations via email.
     *
     * @param  GenerateOrderLabel  $event
     * @return void
     */
    public function handle(GenerateOrderLabel $event)
    {
        $recipient = $event->order->user;
        Mail::to($recipient)->send(new Label($event->order));
    }
}
