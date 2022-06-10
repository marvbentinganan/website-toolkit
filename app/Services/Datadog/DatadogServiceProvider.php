<?php

namespace App\Services\Datadog;

use App\Services\Datadog\Commands\ImportDatadogHosts;
use App\Services\Datadog\Commands\ProcessDatadogHosts;
use Illuminate\Support\ServiceProvider;

class DatadogServiceProvider extends ServiceProvider
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
                ImportDatadogHosts::class,
                ProcessDatadogHosts::class,
            ]);
        }
    }
}
