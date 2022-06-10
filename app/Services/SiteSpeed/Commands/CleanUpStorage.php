<?php

namespace App\Services\SiteSpeed\Commands;

use Illuminate\Console\Command;

class CleanUpStorage extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'wtk:sitespeed-cleanup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This will remove all the older logs and from a given day';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        collect(\Illuminate\Support\Facades\Storage::directories('sitespeed-result'))
            ->filter(function ($dir) {
                // Filter out all directory that only contains 1 folder
                // Because 1 folder means that's it's only having 1 data
                return count(\Illuminate\Support\Facades\Storage::directories($dir)) > 1;
            })
            ->flatMap(function ($dir) {
                // Get all sub-directory for this folder.
                return collect(\Illuminate\Support\Facades\Storage::directories($dir));
            })
            ->filter(function ($dir) {
                // Double check if folder is sub-folder
                $countDepth = \Illuminate\Support\Str::of($dir)->explode('/')->count();

                return $countDepth > 2;
            })->filter(function ($dir) {
                $lastModified = \Illuminate\Support\Facades\Storage::lastModified($dir);

                return now()->subDays(1)->startOfDay()->greaterThan(\Carbon\Carbon::parse($lastModified));
            })->each(function ($dir) {
                \Illuminate\Support\Facades\Storage::deleteDirectory($dir);
            });

        return 0;
    }
}
