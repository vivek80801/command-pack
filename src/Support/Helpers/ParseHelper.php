<?php

namespace Vivek\CommandPack\Support\Helpers;

use Exception;

class ParseHelper
{
    /** @param string $dir */
    public function is_nested($dir): bool
    {
        return $dir[0] === "{" && $dir[strlen($dir) - 1] === "}";
    }

    /**
    * @param string $input
    * @return array{dirs: string, files: string}
    * */
    public function parse ($input):  array
    {
        if($this->is_nested($input))
        {
            throw new Exception('Wront Input');
        }
        $dir_and_file_array = explode("/", $input);
        if(count($dir_and_file_array) !== 2)
        {
            throw new Exception('Not Supported');
        }
        [$dirs, $files] = $dir_and_file_array;
        $result = [];
        $dir_name = "dirs";
        $file_name = "files";

        if($this->is_nested($dirs))
        {
            $list_of_dir = $this->parse_string($dirs);
            $result[$dir_name] = $list_of_dir;
        }else {
            $result[$dir_name] = [$dirs];
        }
        if($this->is_nested($files))
        {
            $list_of_files = $this->parse_string($files);
            $result[$file_name] = $list_of_files;
        } else{
            $result[$file_name] = [$files];
        }
        return $result;
    }


    /** @return string[] */
    public function parse_string (string $input): array
    {
        return array_map('trim', explode(",", trim($input, '{}')));
    }
}
