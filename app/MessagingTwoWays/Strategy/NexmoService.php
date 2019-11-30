<?php
namespace App\MessagingTwoWays\Strategy;

class NexmoService implements MessagingService
{
    public function send()
    {
        dd('Strategy => Nexmo');

    }
}
