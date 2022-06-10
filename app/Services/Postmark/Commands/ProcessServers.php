<?php

namespace App\Services\Postmark\Commands;

use App\Models\Domain;
use App\Models\ImportStatus;
use App\Services\Postmark\Models\ImportPostmarkServer;
use App\Services\Postmark\Models\PostmarkServer;
use App\Services\Postmark\Postmark;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

class ProcessServers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'wtk:postmark-process-servers';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Process servers from import_postmark_servers table';

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
        $postmark = new Postmark();

        ImportPostmarkServer::whereNull('processed_at')
        ->where('import_status_id', ImportStatus::PENDING)
        ->chunkByid(5, function ($servers) use ($postmark) {
            $servers->each(function ($server) use ($postmark) {
                $apiToken = $postmark->getServerApiToken($server->source_server_id);
                $rootDomain = $this->getDomain($server->postmark_name);
                $domain = Domain::where('url', 'ilike', $rootDomain)->first();

                PostmarkServer::updateOrCreate(
                    [
                        'source_server_id' => $server->source_server_id
                    ],
                    [
                        'source_server_id' => $server->source_server_id,
                        'postmark_name' => $server->postmark_name,
                        'postmark_api_token' => $apiToken,
                        'domain_id' => isset($domain) ? $domain->snipeit_asset_id : null
                    ]
                );

                $server->update(['import_status_id' => ImportStatus::SUCCESS, 'processed_at' => now()]);
            });
        });

        return 0;
    }

    private function getDomain($url)
    {
        return Str::of($url)
            ->replace('http://', '')
            ->replace('https://', '')
            ->replace('www.', '')
            ->trim();
    }
}
