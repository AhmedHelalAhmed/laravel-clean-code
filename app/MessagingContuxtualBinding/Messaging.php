<?php
namespace App\MessagingContuxtualBinding;

use App\MessagingContuxtualBinding\Contracts\MessagingService;

class Messaging
{
    private $messagingService;

    public function __construct(MessagingService $messagingService)
    {

        $this->messagingService = $messagingService;
    }

    public function send()
    {
        $this->messagingService->send();

    }
}
