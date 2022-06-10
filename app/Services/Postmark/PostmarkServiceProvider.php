<?php

namespace App\Services\Postmark;

use App\Services\Postmark\Commands\ImportServers;
use App\Services\Postmark\Commands\ImportStats;
use App\Services\Postmark\Commands\ProcessServers;
use App\Services\Postmark\Commands\ProcessStats;
use Illuminate\Support\ServiceProvider;

class PostmarkServiceProvider extends ServiceProvider
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
                ImportServers::class,
                ProcessServers::class,
                ImportStats::class,
                ProcessStats::class,
            ]);
        }
    }
}
