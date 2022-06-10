<?php

namespace App\Services\SiteSpeed\Commands;

use App\Models\Domain;
use App\Services\SiteSpeed\Jobs\ScanDomain;
use Illuminate\Console\Command;

class SiteSpeedScan extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'wtk:sitespeed-scan 
                            {domainID? : Domain ID}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Run a SiteSpeed Scan for a given Domain';

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
        Domain::where('sitespeed_scan', true)
            ->when(!blank($this->argument('domainID')), function ($query) {
                $query->where('domain_id', $this->argument('domainID'));
            })
            ->chunkById(10, function ($domains) {
                $domains->each(function ($domain) {
                    ScanDomain::dispatch($domain);
                    sleep(60);
                });
            });

        return 0;
    }
}
