<?php

namespace Database\Seeders;

use App\Models\MetricSource;
use Illuminate\Database\Seeder;

class MetricSourceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sources = collect([
            ['name' => 'hetrix', 'incoming_webhook_key' => '4YjtkbBWr3MbwXZ5GKya'],
            ['name' => 'datadog', 'incoming_webhook_key' => 'oqJIbFHqzQrGzsnu8MzH'],
            ['name' => 'bugsnag', 'incoming_webhook_key' => 'mFIxc5jlXHgdHkRqseuV'],
            ['name' => 'sitespeed', 'incoming_webhook_key' => 'XA7t7S2wnRaVdxE4LQfP'],
            ['name' => 'postmark', 'incoming_webhook_key' => 'AMoMpKmShmGb7rFj2aFA'],
        ]);

        $sources->each(function ($source) {
            MetricSource::updateOrCreate(
                [
                    'name' => $source['name'],
                ],
                [
                    'name' => $source['name'],
                    'incoming_webhook_key' => $source['incoming_webhook_key']
                ]
            );
        });
    }
}
