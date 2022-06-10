<?php

namespace App\Services\SiteSpeed\Commands;

use App\Models\ImportStatus;
use App\Models\Metrics;
use App\Models\MetricSource;
use App\Services\SiteSpeed\Models\ImportSiteSpeedData;
use App\Services\SiteSpeed\Models\SiteSpeedMetricData;
use Illuminate\Console\Command;

class SiteSpeedProcess extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'wca:sitespeed-process';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Process SiteSpeed results';

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
        $metrics = Metrics::select(['metric_id', 'metric_key', 'unit_of_measure_id', 'reference_key'])->where('metric_source_id', MetricSource::SITESPEED)->get();

        ImportSiteSpeedData::whereNull('processed_at')->each(function ($result) use ($metrics) {
            rescue(function () use ($metrics, $result) {
                return collect($metrics)->map(function ($key) use ($result) {
                    $parsed = $this->process($key->metric_key, $result->data);
                    SiteSpeedMetricData::create(
                        [
                            'domain_id' => $result->snipeit_asset_id,
                            'sitespeed_metric_id' => $key->reference_key,
                            'metric_id' => $key->metric_id,
                            'unit_of_measure_id' => !blank($key->unit_of_measure_id) ? $key->unit_of_measure_id : null,
                            'median' => isset($parsed->median) ? $parsed->median : null,
                            'mean' => isset($parsed->mean) ? $parsed->mean : null,
                            'min' => isset($parsed->min) ? $parsed->min : null,
                            'p90' => isset($parsed->p90) ? $parsed->p90 : null,
                            'max' => isset($parsed->max) ? $parsed->max : null,
                        ]
                    );

                    $result->update(['import_status_id' => ImportStatus::SUCCESS, 'processed_at' => now()]);
                });
            }, function () use ($result) {
                $result->update(['import_status_id' => ImportStatus::FAILURE]);
            });
        });

        return 0;
    }


    public function process($key, $data)
    {
        $numberOfSplits = substr_count($key, '_');
        if ($numberOfSplits == 1) {
            list($first, $second) = explode('_', $key);
            if (isset($data->$first->$second)) {
                return  $data->$first->$second;
            }
        }
        if ($numberOfSplits == 2) {
            list($first, $second, $third) = explode('_', $key);
            if (isset($data->$first->$second->$third)) {
                return  $data->$first->$second->$third;
            }
        }
        if ($numberOfSplits == 3) {
            list($first, $second, $third, $fourth) = explode('_', $key);
            if (isset($data->$first->$second->$third->$fourth)) {
                return  $data->$first->$second->$third->$fourth;
            }
        }
        if ($numberOfSplits == 4) {
            list($first, $second, $third, $fourth, $fifth) = explode('_', $key);
            if (isset($data->$first->$second->$third->$fourth->$fifth)) {
                return  $data->$first->$second->$third->$fourth->$fifth;
            }
        }
    }
}
