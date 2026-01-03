<?php

namespace Vivek\CommandPack\Support\Helpers;

class ContextHelper
{
    public function __construct
    (
        public string $basePath,
        public string $namespace,
        public string $extension,
        public string $stubName
    )
    { }
}
