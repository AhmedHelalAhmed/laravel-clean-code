<?php
namespace App\MessagingContuxtualBinding;

use App\MessagingContuxtualBinding\Contracts\MessagingService;

class TwilioService implements MessagingService
{
    public function send()
    {
        dd('twilio');

    }

}
