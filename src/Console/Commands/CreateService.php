<?php

namespace vivek\CommandPack\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Config;
use vivek\CommandPack\Support\Helpers\ViewHelper;

class CreateService extends Command
{
    protected $signature = 'make:createService {service}';
    protected $description = 'Usage: php artisan make:createService "{products,roles,categories}/{index,create,edit}".
            It will create index.blade.php, create.blade.php, edit.blade.php in products, roles, categories folder all at once.
            This is just an example you can create more of these structure from this package easily
        ';

    public function handle()
    {
        $config_dir = Config::get("command-pack.services_folder");
        if(!is_dir(base_path() . "/" . $config_dir))
        {
            mkdir(base_path() . "/" . $config_dir);
        }
        $namespace = ucfirst(str_replace("/", "\\", $config_dir));
        ViewHelper::createFile($this->argument("service"), base_path() . "/" . $config_dir, $this, ".php", $namespace, "service");
    }
}

