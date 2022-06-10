<?php

namespace App\Console\Commands;

use App\Models\MetricSource;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

class AddWebhookProvider extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'wtk:add-webhook-provider';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Add New Webhooks with key';

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
        $this->info('Current Providers');

        $this->table(
            ['id', 'name', 'incoming webhook key'],
            MetricSource::all(['metric_source_id', 'name', 'incoming_webhook_key'])->toArray()
        );

        $name = $this->ask('What is your webhook name?');
        $key = Str::random(20);

        $source = new MetricSource();
        $source->name = $name;
        $source->incoming_webhook_key = $key;
        $source->save();

        $this->info(sprintf('Added new provier with key: %s', $key));

        return 0;
    }
}
