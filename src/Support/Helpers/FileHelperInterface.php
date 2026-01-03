<?php

namespace Vivek\CommandPack\Support\Helpers;

interface FileHelperInterface
{
    public function exists(string $path): bool;
    public function mkdir(string $path): void;
    public function write(string $path, string $content): int | false;
    public function read(string $path): string;
}
