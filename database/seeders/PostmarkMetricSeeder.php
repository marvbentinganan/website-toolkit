<?php

namespace Database\Seeders;

use App\Models\Metrics;
use App\Models\MetricSource;
use App\Services\Postmark\Models\PostmarkMetric;
use Illuminate\Database\Seeder;

class PostmarkMetricSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // collect(['Sent', 'Bounced', 'SMTPApiErrors', 'BounceRate', 'SpamComplaints', 'SpamComplaintsRate', 'Tracked', 'Opens', 'UniqueOpens', 'TotalClicks', 'UniqueLinksClicked', 'WithClientRecorded', 'WithPlatformRecorded', 'WithReadTimeRecorded', 'WithLinkTracking', 'WithOpenTracking', 'TotalTrackedLinksSent'])
        // ->each(function ($metric) {
        //     PostmarkMetric::updateOrCreate(
        //         [
        //             'metric_key' => $metric
        //         ],
        //         [
        //             'metric_key' => $metric
        //         ]
        //     );
        // });

        $postmarkMetrics = PostmarkMetric::orderBy('postmark_metric_id')->get();

        $postmarkMetrics->each(function ($metric) {
            Metrics::updateorCreate(
                [
                    'metric_source_id' => MetricSource::POSTMARK,
                    'metric_key' => $metric->metric_key
                ],
                [
                    'metric_source_id' => MetricSource::POSTMARK,
                    'metric_key' => $metric->metric_key,
                    'metric_priority_id' => 5,
                    'unit_of_measure_id' => 1,
                    'name' => $metric->name,
                    'reference_key' => $metric->postmark_metric_id,
                    'minimum_threshold' => $metric->minimum_treshold,
                    'maximum_threshold' => $metric->maximum_threshold
                ]
            );
        });
    }
}
