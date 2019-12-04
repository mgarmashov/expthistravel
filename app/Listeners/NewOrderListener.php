<?php

namespace App\Listeners;

use App\Events\NewOrderEvent;
use App\Mail\NewOrder;
use App\Models\User;
use App\Notifications\NewOrderNotification;
use App\Notifications\ThanksForOrderNotification;
use App\Services\AdminNotifications;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Notification;

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
        $clientEmail = request()->b_email;

        AdminNotifications::AdminNotify(new NewOrderNotification($event->order));
        Mail::to($clientEmail)->send(new NewOrder());
    }
}
