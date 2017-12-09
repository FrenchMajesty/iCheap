<?php

namespace App\Events\Accounts;

use App\User;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class RequestVerificationLink
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * User instance of the user who requested another verification link
     * @var User
     */
    public $user;

    /**
     * Unique email verification token
     * @var string
     */
    public $token;

    /**
     * Create the new event instance
     * @param User $user User instance of the requestor
     */
    public function __construct(User $user)
    {
        $this->user = $user;
        $this->token = $user->emailVerificationToken->token;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('channel-name');
    }
}
