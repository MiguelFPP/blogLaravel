<?php

namespace App\Listeners;

use App\Events\PasswordChangeEvent;
use App\Notifications\PasswordChangeNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;

class PasswordChangeListener
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
    public function handle(PasswordChangeEvent $event)
    {
        Notification::send($event->user, new PasswordChangeNotification($event->user));
    }
}
