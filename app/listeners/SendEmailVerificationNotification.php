<?php

namespace App\listeners;

use App\Events\UserWasRegistered;
use App\Mail\ActivationSent;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Mail;

class SendEmailVerificationNotification implements ShouldQueue
{


    /**
     * Handle the event.
     *
     * @param  UserWasRegistered $event
     * @return void
     */
    public function handle(UserWasRegistered $event)
    {
        Mail::to($event->user)->send(new ActivationSent($event->user, $event->token));
    }
}
