<?php

namespace Vivek\CommandPack\Support\Helpers;

use Vivek\CommandPack\Support\Helpers\FileHelperInterface;

class FileHelper implements FileHelperInterface
{
    public function exists(string $path): bool
    {
        return file_exists($path);
    }

    public function write(string $path, string $content): int | false
    {
        return file_put_contents($path, $content);
    }

    public function read(string $path): string
    {
        return file_get_contents($path);
    }

    public function mkdir(string $path): void
    {
        mkdir($path);
    }
}
