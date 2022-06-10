<?php

namespace App\Services\LogParser\Jobs;

use App\Models\Domain;
use App\Services\LogParser\Models\ImportWebServerLog;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class CreateImportWebServerLog implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $data;
    public $log;

    /**
     * The number of times the job may be attempted.
     *
     * @var int
     */
    public $tries = 3;

    /**
     * The maximum number of unhandled exceptions to allow before failing.
     *
     * @var int
     */
    public $maxExceptions = 1;

    /**
     * The number of seconds the job can run before timing out.
     *
     * @var int
     */
    public $timeout = 60;

    /**
     * Create a new job instance.
     *
     * @return void
     * @param Request $data
     * @param Collection $log
     */
    public function __construct($data, $log)
    {
        $this->data = $data;
        $this->log = collect($log);
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // Get SnipeIt Asset ID
        $domain = Domain::select('domain_id')->where('domain_id', $this->data['domain_id'])->first();
        $unique_key_id = sprintf('%s%s', $domain->snipeit_asset_id, $this->log->get('stamp'));

        ImportWebServerLog::firstOrCreate(
            [
                'log_unique_id' => $unique_key_id,
            ],
            [
                'log_unique_id' => $unique_key_id,
                'import_group_id' => $this->data['import_group_id'],
                'domain_id' => $domain->snipeit_asset_id,
                'server_id' => $this->data['server_id'],
                'type' => $this->data['type'],
                'data' => $this->log
            ]
        );

        return;
    }
}
