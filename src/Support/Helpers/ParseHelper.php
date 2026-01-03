<?php

namespace Vivek\CommandPack\Support\Helpers;

use Exception;

class ParseHelper
{
    /** @param string $dir */
    public function is_nested($dir): bool
    {
        return strlen($dir) > 0 &&
            $dir[0] === "{" &&
            $dir[strlen($dir) - 1] === "}";
    }

      /**
     * @parm string $input
     * @return array{dirs: string[], files: string[]}
     */
    public function parse(string $input): array
    {
        $seperator = '/';
        if ($input === '') {
            throw new Exception('Input cannot be empty');
        }

        if ($this->is_nested($input)) {
            throw new Exception('Whole input cannot be nested');
        }

        if(!str_contains($input, $seperator))
        {
            return [
                'dirs'  => $input,
                'files' => [],
            ];
        }
        $parts = explode($seperator, $input);

        if (count($parts) > 2) {
            throw new Exception('Nested paths not supported');
        }

        [$dirs, $files] = array_pad($parts, 2, '');

        return [
            'dirs'  => $this->parsePart($dirs),
            'files' => $this->parsePart($files),
        ];
    }

      /** @return string[] */
    private function parsePart(string $part): array
    {
        if ($part === '') {
            return [];
        }

        if ($this->is_nested($part)) {
            return $this->parse_string($part);
        }

        return [$part];
    }

    /** @return string[] */
    public function parse_string (string $input): array
    {
        return array_map('trim', explode(",", trim($input, '{}')));
    }
}
