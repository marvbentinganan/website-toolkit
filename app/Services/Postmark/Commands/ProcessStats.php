<?php

namespace App\Services\Postmark\Commands;

use App\Models\ImportStatus;
use App\Models\Metrics;
use App\Models\MetricSource;
use App\Services\Postmark\Models\ImportPostmarkServerStats;
use App\Services\Postmark\Models\PostmarkMetricData;
use Illuminate\Console\Command;

class ProcessStats extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'wca:postmark-process-stats';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Process servers from import_postmark_server_stats table';

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
        $metrics = Metrics::select('metric_id', 'reference_key', 'metric_key')->where('metric_source_id', MetricSource::POSTMARK)->get();

        ImportPostmarkServerStats::whereNull('processed_at')->whereIn('import_status_id', [ImportStatus::PENDING, ImportStatus::FAILURE])
        ->each(function ($stat) use ($metrics) {
            rescue(function () use ($metrics, $stat) {
                $metrics->each(function ($metric) use ($stat) {
                    $key = $metric->metric_key;
                    PostmarkMetricData::updateOrCreate(
                        [
                            'domain_id' => $stat->domain_id,
                            'metric_date' => $stat->metric_date,
                            'metric_id' => $metric->metric_id,
                        ],
                        [
                            'domain_id' => $stat->domain_id,
                            'postmark_metric_id' => $metric->reference_key,
                            'postmark_server_id' => $stat->postmark_server_id,
                            'metric_date' => $stat->metric_date,
                            'metric_id' => $metric->metric_id,
                            'value' => $stat->data->$key
                        ]
                    );
                });
                $stat->update(['import_status_id' => ImportStatus::SUCCESS, 'processed_at' => now()]);
            }, function () use ($stat) {
                $stat->update(['import_status_id' => ImportStatus::FAILURE]);
            });
        });

        return 0;
    }
}
