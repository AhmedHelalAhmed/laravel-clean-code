<?php

namespace App\Mail;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class ActivationSent extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public $user,$token;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(User $user,$token)
    {
        $this->user=$user;
        $this->token=$token;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('mails.activation');
    }
}
