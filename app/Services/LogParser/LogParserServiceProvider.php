<?php

namespace App\Services\LogParser;

use App\Services\LogParser\Commands\ProcessLogs;
use Illuminate\Support\ServiceProvider;

class LogParserServiceProvider extends ServiceProvider
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
                ProcessLogs::class,
            ]);
        }
    }
}
