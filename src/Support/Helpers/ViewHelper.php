<?php
namespace Vivek\CommandPack\Support\Helpers;

use Vivek\CommandPack\Support\Helpers\ContextHelper;
use Vivek\CommandPack\Support\Helpers\FileHelper;
use Vivek\CommandPack\Support\Helpers\StubHelper;

class ViewHelper
{
    public function __construct(
      private FileHelper $file_helper,
      private StubHelper $stub_helper,
      private ParseHelper $parse_helper,
      private $logger
    ) {}
    public function createFile
    (
        string $command_input,
        ContextHelper  $ctx
    ): void
    {
        $list_of_files_and_dirs = $this->parse_helper->parse($command_input);
        $files = $list_of_files_and_dirs["files"];
        $dirs = $list_of_files_and_dirs["dirs"];

        foreach($dirs as $dir)
        {
            $this->file_helper->mkdir($dir);
            foreach($files as $file)
            {
                $stub_content = $this->stub_helper->get_stub(
                    $ctx->basePath . "/" . $ctx->stubName,
                    $ctx->namespace,
                    $ctx->extension
                );
                $this->file_helper->write($file, $stub_content);
            }
        }
    }
}
