<?php

namespace App\listeners;

use App\Events\UserWasRegistered;
use App\Mail\ActivationSent;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Mail;

class SendEmailVerificationNotification implements ShouldQueue
{


    use InteractsWithQueue, Queueable;

    // do not consume the queue if you do not need it

    public function sholudQueue($event)
    {


        // dd($event); // based on the information of the event
        // return false;// to make the event not dispatched to the queue

        return true;// to allow event to work and enter the queue
    }


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
