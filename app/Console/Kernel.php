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
        $schedule->command('wca:postmark-import-stats')
        ->dailyAt('0:05')
        ->withoutOverlapping()
        ->runInBackground()
        ->onOneServer();

        $schedule->command('wca:postmark-process-stats')
        ->dailyAt('0:10')
        ->withoutOverlapping()
        ->runInBackground()
        ->onOneServer();

        $schedule->command('wca:process-agent-data')
        ->dailyAt('1:00')
        ->withoutOverlapping()
        ->runInBackground()
        ->onOneServer();

        $schedule->command('wca:sitespeed-scan')
        ->sundays()
        ->at('2:00')
        ->withoutOverlapping()
        ->runInBackground()
        ->onOneServer();

        $schedule->command('wca:sitespeed-process')
        ->sundays()
        ->at('4:00')
        ->withoutOverlapping()
        ->runInBackground()
        ->onOneServer();

        $schedule->command('wca:hetrix-process-import')
        ->everyMinute()
        ->withoutOverlapping()
        ->runInBackground()
        ->onOneServer();

        $schedule->command('wca:import-datadog-hosts')
        ->dailyAt('0:15')
        ->withoutOverlapping()
        ->runInBackground()
        ->onOneServer();

        $schedule->command('wca:process-datadog-hosts')
        ->dailyAt('0:20')
        ->withoutOverlapping()
        ->runInBackground()
        ->onOneServer();

        $schedule->command('wca:import-forge-servers')
        ->weeklyOn(1, '8:00')
        ->withoutOverlapping()
        ->runInBackground()
        ->onOneServer();

        $schedule->command('wca:process-forge-servers')
        ->weeklyOn(1, '8:05')
        ->withoutOverlapping()
        ->runInBackground()
        ->onOneServer();

        $schedule->command('wca:import-forge-sites')
        ->weeklyOn(1, '8:10')
        ->withoutOverlapping()
        ->runInBackground()
        ->onOneServer();

        $schedule->command('wca:process-forge-sites')
        ->weeklyOn(1, '8:15')
        ->withoutOverlapping()
        ->runInBackground()
        ->onOneServer();

        $schedule->command('wca:import-datadog-http-logs')
        ->everyTwoHours()
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
