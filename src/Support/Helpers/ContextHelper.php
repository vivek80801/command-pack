<?php

namespace Vivek\CommandPack\Support\Helpers;

class ContextHelper
{
    public function __construct
    (
        public string $base_path,
        public string $namespace,
        public string $extension,
        public string $stub_name
    )
    { }
}
