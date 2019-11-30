<?php
namespace App\MessagingContuxtualBinding;

use App\MessagingContuxtualBinding\Contracts\MessagingService;

class NexmoService implements MessagingService
{
    public function send()
    {
        dd('nexmo');

    }

}
