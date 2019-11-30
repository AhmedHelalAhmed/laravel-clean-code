<?php
namespace App\Logging;

class FileLogger implements LoggerInterface
{
    public function log()
    {
        dd('log to file');

    }
}
