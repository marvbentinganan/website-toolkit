<?php

namespace App\Services\Postmark\Commands;

use App\Models\ImportStatus;
use App\Services\Postmark\Models\ImportPostmarkServerStats;
use App\Services\Postmark\Models\PostmarkServer;
use App\Services\Postmark\Postmark;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

class ImportStats extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'wca:postmark-import-stats
                            {startDate?}
                            {endDate?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import server stats from Postmark';

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
        if (blank($this->argument('startDate'))) {
            $dateRange = Carbon::parse(now()->subDay(1)->startOfDay())->toPeriod(Carbon::parse(now()->subDay(1)->endOfDay()));
        } else {
            $dateRange = Carbon::parse($this->argument('startDate'))->toPeriod(Carbon::parse($this->argument('endDate')));
        }

        PostmarkServer::whereNotNull('domain_id')->cursor()->each(function ($domain) use ($dateRange) {
            collect($dateRange)->each(function ($date) use ($domain) {
                $postmark = new Postmark();
                $metricDate = $date->format('Y-m-d');
                $data = $postmark->getServerStats(
                    $metricDate,
                    $metricDate,
                    $domain->postmark_api_token
                );

                $this->info('Importing Postmark Stats for ' . $domain->postmark_name);

                ImportPostmarkServerStats::create(
                    [
                        'import_group_id' => Str::uuid()->toString(),
                        'import_status_id' => ImportStatus::PENDING,
                        'domain_id' => $domain->domain_id,
                        'postmark_server_id' => $domain->postmark_server_id,
                        'metric_date' => $metricDate,
                        'data' => collect($data)
                    ]
                );
            });
        });

        return 0;
    }
}
