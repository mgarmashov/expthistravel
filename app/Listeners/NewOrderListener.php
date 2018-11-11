<?php

namespace App\Listeners;

use App\Events\NewOrderEvent;
use App\Models\User;
use App\Notifications\NewOrderNotification;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class NewOrderListener
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
     * @param  object  $event
     * @return void
     */
    public function handle(NewOrderEvent $event)
    {
        $user = User::where('login', env('USER_NOTIFY', 'root'))->first();

        $user->notify(new NewOrderNotification($event->order));
    }
}
