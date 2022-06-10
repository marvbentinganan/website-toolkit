<?php

namespace App\Services\Forge\Commands;

use App\Models\ImportStatus;
use App\Models\Server;
use App\Services\Forge\Models\ForgeServer;
use App\Services\Forge\Models\ImportForgeServers;
use Illuminate\Console\Command;

class ProcessForgeServers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'wca:process-forge-servers';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Process imported server data from Laravel Forge';

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
        ImportForgeServers::whereNull('processed_at')->each(function ($serverData) {
            $this->info('Processing Laravel Forge Servers : ' . $serverData->import_group_id);
            rescue(function () use ($serverData) {
                collect($serverData->data)->each(function ($server) {
                    // Find Existing Server
                    $existing = Server::where('ip_address', $server->ip_address)->first();

                    $server = ForgeServer::updateOrCreate([
                        'ip_address' => $server->ip_address
                    ], [
                        'ip_address' => $server->ip_address,
                        'private_ip_address' => $server->private_ip_address,
                        'name' => $server->name,
                        'size' => $server->size,
                        'region' => $server->region,
                        'php_version' => $server->php_version,
                        'source_id' => $server->id,
                        'server_id' => isset($existing) ? $existing->getKey() : null
                    ]);
                });
                $serverData->update(['import_status_id' => ImportStatus::SUCCESS, 'processed_at' => now()]);
            }, function () use ($serverData) {
                $serverData->update(['import_status_id' => ImportStatus::FAILURE]);
            });
        });

        return Command::SUCCESS;
    }
}
