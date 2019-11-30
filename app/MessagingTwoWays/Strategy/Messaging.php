<?php
namespace App\MessagingTwoWays\Strategy;

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
