<?php

namespace Vivek\CommandPack\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Config;
use Vivek\CommandPack\Support\Helpers\ContextHelper;
use Vivek\CommandPack\Support\Helpers\FileHelper;
use Vivek\CommandPack\Support\Helpers\Logger;
use Vivek\CommandPack\Support\Helpers\ParseHelper;
use Vivek\CommandPack\Support\Helpers\StubHelper;
use Vivek\CommandPack\Support\Helpers\ViewHelper;

class CreateRepository extends Command
{
    protected $signature = 'make:createRepository {repo}';
    protected $description = 'Usage: php artisan make:createRepository "{products,roles,categories}/{index,create,edit}".
            It will create index.blade.php, create.blade.php, edit.blade.php in products, roles, categories folder all at once.
            This is just an example you can create more of these structure from this package easily
        ';

    public function handle()
    {
        $config_dir = Config::get("command-pack.repositories_folder");
        if(!is_dir(base_path() . "/" . $config_dir))
        {
            mkdir(base_path() . "/" . $config_dir);
        }
        $namespace = ucfirst(str_replace("/", "\\", $config_dir));

        $base_path = base_path() . "/" . $config_dir;
        $file_helper = new FileHelper();
        $stub_helper = new StubHelper();
        $parse_helper = new ParseHelper();
        $logger = new Logger();

        $ctx = new ContextHelper($base_path, $namespace, ".php", "repository");

        $view_helper = new ViewHelper($file_helper, $stub_helper, $parse_helper, $logger);
        $view_helper->createFile($this->argument("repo"), $ctx);
    }
}

