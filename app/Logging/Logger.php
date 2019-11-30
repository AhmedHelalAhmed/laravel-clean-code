<?php
namespace App\Logging;

class Logger
{
    private $logger;

    public function __construct(LoggerInterface $logger)
    {

        $this->logger = $logger;
    }
    public function log()
    {
        $this->logger->log();

    }
}
