<?php

namespace App;

class Logger
{
    public function log(string $message): void
    {
        file_put_contents(__DIR__ . '/../logs/php.log',$message,1);
    }

}

