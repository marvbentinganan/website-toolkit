<?php

namespace App\Console;

use App\Services\WebsiteCustodian\Commands\AgentData;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param \Illuminate\Console\Scheduling\Schedule $schedule
     *
     * @return void
     */
    protected $commands = [
        AgentData::class,
    ];

    protected function schedule(Schedule $schedule)
    {
        $schedule->command('wtk:import-postmark-stats')
        ->dailyAt('0:05')
        ->withoutOverlapping()
        ->runInBackground()
        ->onOneServer();

        $schedule->command('wtk:process-postmark-stats')
        ->dailyAt('0:10')
        ->withoutOverlapping()
        ->runInBackground()
        ->onOneServer();

        $schedule->command('wtk:sitespeed-scan')
        ->sundays()
        ->at('2:00')
        ->withoutOverlapping()
        ->runInBackground()
        ->onOneServer();

        $schedule->command('wtk:sitespeed-process')
        ->sundays()
        ->at('4:00')
        ->withoutOverlapping()
        ->runInBackground()
        ->onOneServer();

        $schedule->command('wtk:import-datadog-hosts')
        ->dailyAt('0:15')
        ->withoutOverlapping()
        ->runInBackground()
        ->onOneServer();

        $schedule->command('wtk:process-datadog-hosts')
        ->dailyAt('0:20')
        ->withoutOverlapping()
        ->runInBackground()
        ->onOneServer();

        $schedule->command('wtk:import-forge-servers')
        ->weeklyOn(1, '8:00')
        ->withoutOverlapping()
        ->runInBackground()
        ->onOneServer();

        $schedule->command('wtk:process-forge-servers')
        ->weeklyOn(1, '8:05')
        ->withoutOverlapping()
        ->runInBackground()
        ->onOneServer();

        $schedule->command('wtk:import-forge-sites')
        ->weeklyOn(1, '8:10')
        ->withoutOverlapping()
        ->runInBackground()
        ->onOneServer();

        $schedule->command('wtk:process-forge-sites')
        ->weeklyOn(1, '8:15')
        ->withoutOverlapping()
        ->runInBackground()
        ->onOneServer();
    }

    /**
     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
