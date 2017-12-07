<?php

namespace App\Listeners\Sell\Order;

use Mail;
use App\Mail\Sell\Order\BookReceived as BookReceivedEmail;
use App\Events\Sell\Order\BookReceived;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class BookWasReceived
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
     * @param  BookReceived  $event
     * @return void
     */
    public function handle(BookReceived $event)
    {
        $recipient = $event->order->user;
        Mail::to($recipient)->send(new BookReceivedEmail($event->order));   
    }
}
