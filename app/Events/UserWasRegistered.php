<?php

namespace App\Events;

use App\Models\User;
use Illuminate\Queue\SerializesModels;
use Illuminate\Foundation\Events\Dispatchable;


class UserWasRegistered
{
    use Dispatchable, SerializesModels;
    public $user, $token, $feedback;


    /**
     * Create a new event instance.
     * @param User $user
     * @param $token
     */
    public function __construct(User $user, $token)
    {

        $this->user = $user;
        $this->token = $token;
        $this->feedback = 'Email has been sent, check your mail.';
    }


}
