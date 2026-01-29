<?php

namespace Vivek\CommandPack\Support\Helpers;

use Vivek\CommandPack\Support\Helpers\LoggerInterface;


class Logger implements LoggerInterface
{
    public function log(string $item): void
    {
        echo "\x1b[1;35m" . $item . "\x1b[0m". PHP_EOL;
    }
}
