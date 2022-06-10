<?php

namespace App\Services\Datadog\Commands;

use App\Models\ImportStatus;
use App\Models\Server;
use App\Services\Datadog\Models\DatadogHost;
use App\Services\Datadog\Models\DatadogHostApp;
use App\Services\Datadog\Models\ImportDatadogHost;
use Illuminate\Console\Command;

class ProcessDatadogHosts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'wca:process-datadog-hosts';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Process Imported data from Datadog';

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
        ImportDatadogHost::whereNull('processed_at')->each(function ($hostData) {
            $this->info('Processing Datadog Hosts : ' . $hostData->import_group_id);
            rescue(function () use ($hostData) {
                $host = $hostData->data;
                $server = Server::where('snipeit_hostname', $host->host_name)->first();

                if (! blank($server)) {
                    $localServer = DatadogHost::updateOrCreate(
                        [
                            'hostname' => $host->host_name,
                            'server_id' => $server->getKey()
                        ],
                        [
                            'service_host_id' => $host->id,
                            'hostname' => $host->host_name,
                            'server_id' => $server->getKey(),
                            'status' => $host->up,
                            'agent_version' => $host->meta->agent_version,
                            'platform' => $host->meta->platform
                        ]
                    );

                    collect($host->apps)->each(function ($app) use ($server, $localServer) {
                        DatadogHostApp::updateOrCreate(
                            [
                                'datadog_host_id' => $localServer->datadog_host_id,
                                'server_id' => $server->getKey(),
                                'name' => $app
                            ]
                        );
                    });
                }

                $hostData->update(['import_status_id' => ImportStatus::SUCCESS, 'processed_at' => now()]);
            }, function () use ($hostData) {
                $hostData->update(['import_status_id' => ImportStatus::FAILURE]);
            });
        });

        return Command::SUCCESS;
    }
}
