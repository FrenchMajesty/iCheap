<?php

namespace App\Listeners\Accounts;

use Mail;
use App\Mail\Accounts\VerifyEmail;
use App\Events\Accounts\RequestVerificationLink;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class VerificationLinkWasRequested
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
     * @param  RequestVerificationLink  $event
     * @return void
     */
    public function handle(RequestVerificationLink $event)
    {
        Mail::to($event->user)->send(new VerifyEmail($event->user, $event->token));
    }
}
