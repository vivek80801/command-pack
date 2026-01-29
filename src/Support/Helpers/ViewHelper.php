<?php
namespace Vivek\CommandPack\Support\Helpers;

use Vivek\CommandPack\Support\Helpers\ContextHelper;
use Vivek\CommandPack\Support\Helpers\FileHelper;
use Vivek\CommandPack\Support\Helpers\StubHelper;
use Vivek\CommandPack\Support\Helpers\Logger;

class ViewHelper
{
    public function __construct(
      private FileHelper $file_helper,
      private StubHelper $stub_helper,
      private ParseHelper $parse_helper,
      private Logger $logger,
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

        if ($dirs === []) {
         $this->create_files($files, '.', $ctx);
         return;
        }

        foreach ($dirs as $dir) {
            $dir_path = $ctx->base_path . "/" . $dir;
            // file_exists checks for both file and folder
            if(!file_exists($dir_path))
            {
                $this->file_helper->mkdir($dir_path);
                $this->logger->log("Folder: " . $dir_path . " created");
            } else {
                $this->logger->log("Folder: " . $dir_path . " exists. not creating");
            }
            $this->create_files($files, $dir, $ctx);
        }
    }

    /** @param string[] $files */
    public function create_files(
        array $files,
        string $dir,
        ContextHelper $ctx
    ): void
    {
        foreach ($files as $file) {
            $content = $this->stub_helper->get_stub(
                $ctx->stub_name,
                $ctx->namespace,
                $file
            );

            $file_path = $this->build_path($ctx, $dir, $file) . $ctx->extension;
            if(!file_exists($file_path))
            {
                $this->file_helper->write($file_path, $content);
                $this->logger->log("File: " . $file_path . " created");
            }else {
                $this->logger->log("File: " . $file_path . " already exists. not creating");
            }
        }
    }

    private function build_path(
        ContextHelper $ctx,
        string $dir,
        string $file
    ): string
    {
        return rtrim(
                $ctx->base_path,
                '/'
            )
            . (
                $dir !== '.' ? '/' . $dir : ''
            )
            . '/' . $file;
    }
}
