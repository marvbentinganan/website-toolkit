<?php

namespace App\Services\Forge;

use App\Services\Forge\Commands\ImportForgeServers;
use App\Services\Forge\Commands\ImportForgeSites;
use App\Services\Forge\Commands\ProcessForgeServers;
use App\Services\Forge\Commands\ProcessForgeSites;
use Illuminate\Support\ServiceProvider;

class LaravelForgeServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any package services.
     *
     * @return void
     */
    public function boot()
    {
        $this->loadMigrationsFrom(__DIR__.'/Database/Migrations');
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        if ($this->app->runningInConsole()) {
            $this->commands([
                ImportForgeServers::class,
                ProcessForgeServers::class,
                ImportForgeSites::class,
                ProcessForgeSites::class,
            ]);
        }
    }
}
