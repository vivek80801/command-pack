<?php

namespace vivek\CommandPack\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Config;
use vivek\CommandPack\Support\Helpers\ViewHelper;

class CreateAction extends Command
{
    protected $signature = 'make:createAction {action}';
    protected $description = 'Usage: php artisan make:createAction "{products,roles,categories}/{index,create,edit}".
            It will create index.blade.php, create.blade.php, edit.blade.php in products, roles, categories folder all at once.
            This is just an example you can create more of these structure from this package easily
        ';

    public function handle()
    {
        $namespace = ucfirst(Config::get("command-pack.actions_folder"));
        ViewHelper::createFile($this->argument("action"), base_path() . "/" . Config::get("command-pack.actions_folder"), $this, ".php", $namespace, "action");
    }
}

