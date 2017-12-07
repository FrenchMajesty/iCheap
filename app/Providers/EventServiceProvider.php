<?php

namespace App\Providers;

use Illuminate\Support\Facades\Event;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        'App\Events\Accounts\UserRegister' => [
            'App\Listeners\Accounts\NewUserRegistered',
        ],
        'App\Events\Sell\Shipping\GenerateOrderLabel' => [
            'App\Listeners\Sell\Shipping\LabelWasGenerated',
        ],
        'App\Events\Sell\Order\BookReceived' => [
            'App\Listeners\Sell\Order\BookWasReceived'
        ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
