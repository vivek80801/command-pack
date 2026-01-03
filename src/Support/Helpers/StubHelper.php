<?php

namespace Vivek\CommandPack\Support\Helpers;

class StubHelper {
    public function get_stub (string $file_name, string $namespace, string $className)
    {
        $stubPath = __DIR__ . '/../../stubs/' . $file_name . '.stub'; 

        $stub = file_get_contents($stubPath);

        $stub = str_replace(
            ['{{ namespace }}', '{{ class }}'],
            [$namespace, $className],
            $stub
        );
        return $stub;
    }
}
