<?php
namespace App\MessagingTwoWays\Strategy;

class TwilioService implements MessagingService
{
    public function send()
    {
        dd('Strategy => Twilio');

    }
}
