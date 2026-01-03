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

class CreateView extends Command
{
    protected $signature = 'make:createView {view}';
    protected $description = 'Usage: php artisan make:createView "{products,roles,categories}/{index,create,edit}".
            It will create index.blade.php, create.blade.php, edit.blade.php in products, roles, categories folder all at once.
            This is just an example you can create more of these structure from this package easily
        ';

    public function handle()
    {
        $config_dir = Config::get("view.paths")[0];
        if(!is_dir(base_path() . "/" . $config_dir))
        {
            mkdir(base_path() . "/" . $config_dir);
        }
        $namespace = $config_dir;

        $base_path = base_path() . "/" . $config_dir;
        $file_helper = new FileHelper();
        $stub_helper = new StubHelper();
        $parse_helper = new ParseHelper();
        $logger = new Logger();

        $ctx = new ContextHelper($base_path, $namespace, ".blade.php", "view");

        $view_helper = new ViewHelper($file_helper, $stub_helper, $parse_helper, $logger);
        $view_helper->createFile($this->argument("view"), $ctx);
    }
}

