<?php

namespace Vivek\CommandPack\Support\Helpers;

use Vivek\CommandPack\Support\Helpers\LoggerInterface;


class Logger implements LoggerInterface
{
    public function log(string $item): void
    {
        echo $item . PHP_EOL;
    }
}
