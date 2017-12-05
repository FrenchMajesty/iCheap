<?php

namespace App\Mail\Accounts;

use App\User;
use App\Model\Accounts\Registration\EmailVerificationToken;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class VerifyEmail extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * Model of the user receiving this email
     * @var \App\User
     */
    public $user;

    /**
     * Model instance of the email verification token
     * @var string
     */
    public $token;

    /**
     * Main title of this email
     * @var string
     */
    public $title;

    /**
     * Attributes of the button component
     * @var array
     */
    public $button;

    /**
     * Create a new message instance.
     * @param \App\User $user User instance
     * @param string $token Email verification token
     *
     * @return void
     */
    public function __construct(User $user,string $token)
    {
        $this->user = $user;

        $this->title = 'Verify your email and start making money.';
        $this->button['message'] = 'Verify my email now!';
        $this->button['url'] = route('verify.email', ['token' => $token]);
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->markdown('mail.accounts.verify')
                    ->subject('Complete your registration on '.env('APP_NAME'));
    }
}
