<?php

namespace App\Listeners\Accounts;

use Mail;
use App\Mail\Accounts\VerifyEmail;
use App\Model\Accounts\Registration\EmailVerificationToken;
use App\Events\Accounts\UserRegister;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class NewUserRegistered
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
     * @param  UserRegister  $event
     * @return void
     */
    public function handle(UserRegister $event)
    {
        $verification = EmailVerificationToken::create([
            'user_id' => $event->user->id,
            'token' => str_random(50),
        ]);

        Mail::to($event->user)->send(new VerifyEmail($user, $verification->token));
    }
}
