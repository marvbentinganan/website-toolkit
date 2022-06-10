<?php

namespace App\Console\Commands;

use App\Models\Metrics;
use App\Models\MetricSource;
use App\Services\Postmark\Models\PostmarkMetricData;
use App\Services\SiteSpeed\Models\SiteSpeedMetricData;
use Illuminate\Console\Command;

class UpdateMetricId extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'wca:update-metric-id';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update the metric_id in the sitespeed and postmark metrics data tables';

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
        // Process Postmark Metrics
        $postmarkMetrics = PostmarkMetricData::whereNull('metric_id')->get();

        $this->info('Updating Postmark Metric Data');

        $postmarkMetrics->each(function ($metric) {
            $newMetric = Metrics::where('reference_key', $metric->postmark_metric_id)->where('metric_source_id', MetricSource::POSTMARK)->first();
            $metric->update(['metric_id' => $newMetric->metric_id]);
        });

        // Process SiteSpeed Metrics
        $sitespeedMetrics = SiteSpeedMetricData::whereNull('metric_id')->get();

        $this->info('Updating SiteSpeed Metric Data');

        $sitespeedMetrics->each(function ($metric) {
            $newMetric = Metrics::where('reference_key', $metric->sitespeed_metric_id)->where('metric_source_id', MetricSource::SITESPEED)->first();
            $metric->update(['metric_id' => $newMetric->metric_id]);
        });

        return Command::SUCCESS;
    }
}
