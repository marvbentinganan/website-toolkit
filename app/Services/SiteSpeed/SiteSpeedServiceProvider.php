<?php

namespace App\Services\SiteSpeed;

use App\Services\Hetrix\Command\ProcessImport;
use App\Services\SiteSpeed\Commands\CleanUpStorage;
use App\Services\SiteSpeed\Commands\SiteSpeedProcess;
use App\Services\SiteSpeed\Commands\SiteSpeedScan;
use Illuminate\Support\ServiceProvider;

class SiteSpeedServiceProvider extends ServiceProvider
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
                SiteSpeedScan::class,
                SiteSpeedProcess::class,
                CleanUpStorage::class
            ]);
        }
    }
}
