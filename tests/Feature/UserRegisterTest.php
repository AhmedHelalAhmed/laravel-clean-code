<?php

namespace Tests\Feature;

use App\Events\UserWasRegistered;
use App\listeners\SendEmailVerificationNotification;
use App\Mail\ActivationSent;
use Illuminate\Events\CallQueuedListener;
use Tests\TestCase;
use Mail;
use Event;
use Queue;

class UserRegisterTest extends TestCase
{

    /** @test */
    public function it_should_push_the_email_to_the_queue()
    {
        // this no longer valid
        Mail::fake();

        /*
        $this->post('/api/auth/register', $user = [
            'name' => 'ahmed',
            'password' => 'secret123!@#',
            'password_confirmation' => 'secret123!@#',

            'email' => 'ahmed.helal.online@gmail.com'
        ])
            ->assertStatus(201);

        */

        $this->post('/api/auth/register', $user = [
            'name' => 'ahmed',
            'password' => 'secret123!@#',
            'password_confirmation' => 'secret123!@#',
            'email' => 'ahmed.helal.online@gmail.com'
        ]);
        // you may use user factory instead

        Mail::assertQueued(ActivationSent::class, function ($mail) use ($user) {

            //dd($mail);

            return $mail->user->email == $user['email'];

        });

    /*
     *
     * this tested in the app service provider
     *
     *
     */
    }



    // test for event that in queue

    /** @test */
    public function it_should_push_the_email_to_the_queue_via_event()
    {
        //Event::fake();// shoud commentted
        Queue::fake(); // it's the matter of array
        $this->post('/api/auth/register', $user = [
            'name' => 'ahmed',
            'password' => 'secret123!@#',
            'password_confirmation' => 'secret123!@#',

            'email' => 'ahmed.helal.online@gmail.com'
        ]);

        // event => event pushed to queue => mail for jobs => it send listener for the event

        Queue::assertPushed(CallQueuedListener::class, function ($job) {

            //dd($job);

            return $job->class == SendEmailVerificationNotification::class;

        });
        /*
        if you want to test job

          Queue::assertPushed(JobClass::class, function ($job) {

                    //dd($job);

                    return $job->class==SendEmailVerificationNotification::class;

                });


         */

    }


    // test for event that in queue

    /** @test */
    public function it_should_dispatches_the_event_to_the_registered_user()
    {
        Event::fake();
        $this->post('/api/auth/register', $user = [
            'name' => 'ahmed',
            'password' => 'secret123!@#',
            'password_confirmation' => 'secret123!@#',

            'email' => 'ahmed.helal.online@gmail.com'
        ]);


        Event::assertDispatched(UserWasRegistered::class, function ($event) use ($user) {


            return $event->user->email == $user['email'];

        });


    }


}
