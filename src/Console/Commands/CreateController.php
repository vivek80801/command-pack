<?php

namespace vivek\CommandPack\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Config;
use vivek\CommandPack\Support\Helpers\ViewHelper;

class CreateController extends Command
{
    protected $signature = 'make:createController {controller}';
    protected $description = 'Usage: php artisan make:createController "{products,roles,categories}/{index,create,edit}".
            It will create index.blade.php, create.blade.php, edit.blade.php in products, roles, categories folder all at once.
            This is just an example you can create more of these structure from this package easily
        ';

    public function handle()
    {
        $config_dir = Config::get("command-pack.controller_folder");
        if(!is_dir(base_path() . "/" . $config_dir))
        {
            mkdir(base_path() . "/" . $config_dir);
        }
        $namespace = ucfirst($config_dir);
        ViewHelper::createFile($this->argument("controller"), base_path() . "/" . $config_dir, $this, ".php", $namespace, "controller");
    }
}

