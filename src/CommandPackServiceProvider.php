<?php

namespace Vivek\CommandPack;

use Illuminate\Support\ServiceProvider;
use Vivek\CommandPack\Console\Commands\CreateAction;
use Vivek\CommandPack\Console\Commands\CreateController;
use Vivek\CommandPack\Console\Commands\CreateRepository;
use Vivek\CommandPack\Console\Commands\CreateService;
use Vivek\CommandPack\Console\Commands\CreateView;

class CommandPackServiceProvider extends ServiceProvider
{
    public function register()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                CreateView::class,
                CreateAction::class,
                CreateRepository::class,
                CreateService::class,
                CreateController::class,
            ]);

        }

    }

    public function boot()
    {
      $this->publishes([
          __DIR__ . '/config/command-pack.php' => config_path('command-pack.php'),
      ], 'command-pack-config');

      $this->publishes([
          __DIR__.'/stubs' => $this->app->basePath('stubs/vendor/Vivek'),
      ], 'command-pack-stub');
    }
}

