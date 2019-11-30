<?php
namespace App\Logging;

class DatabaseLogger implements LoggerInterface
{
    public function log()
    {
        dd('log to database');

    }
}
