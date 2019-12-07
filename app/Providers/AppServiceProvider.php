<?php

namespace App\Providers;

use Illuminate\Queue\Events\JobFailed;
use Illuminate\Queue\Events\JobProcessed;
use Illuminate\Queue\Events\JobProcessing;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        // after the event done
        // must be tested without event faker
        // it_should_push_the_email_to_the_queue =>  this test to run
        // this will work if the job successfully done otherwise will not enter
        // this to make notifications and good for ux
        \Queue::after(function (JobProcessed $event) {

            // $message = unserialize($event->job->payload()['data']['command'])->data[0]->feedback
            // event(new DispatchNotificationToUserInFrontEnd($message));
            // but this will happened to every event then we need to check the class
            // check if the event have the feedback if it has then dispatch otherwise not


            // dd(unserialize($event->job->payload()['data']['command'])->data[0]->feedback);// main code


            /*
                 make new event something interact with real time to send feedback
                 pusher for example
                 to keep user updated with what happend in frontend
                 user wait email and he does not know the email sent or not
                 reserve order for example
            */

        });


        \Queue::before(function (JobProcessing $event) {
            // to handle event if it failed
//            dd($event);
        });


        // an other way for handling failed events/jobs
        \Queue::failing(function (JobFailed $event) {
//            dd($event);
            log::error('Job failed ' . $event->exception->getMessage());
        });


    }


}
