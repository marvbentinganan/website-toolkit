<?php

namespace App\Services\LogParser\Commands;

use App\Models\ImportStatus;
use App\Services\LogParser\LogLineParser;
use App\Services\LogParser\Models\ImportWebServerLog;
use App\Services\LogParser\Models\WebServer;
use App\Services\LogParser\Models\WebServerLog;
use Illuminate\Console\Command;

class ProcessLogs extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'wc:parse-logs';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Process data from the import_nginx_logs table.';

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
        ImportWebServerLog::whereNull('processed_at')
        ->where('import_status_id', ImportStatus::PENDING)
        ->chunkById(10, function ($logs) {
            $logs->each(function ($log) {
                rescue(function () use ($log) {
                    $parsed = new LogLineParser($log);

                    WebServerLog::create(
                        [
                            'web_server_id' => WebServer::NGINX,
                            'ip_address_id' => $parsed->getIpAddress(),
                            'http_method_id' => $parsed->getMethod(),
                            'domain_id' => $log->domain_id,
                            'domain_url_id' => $parsed->getUrl(),
                            'http_response_id' => $parsed->getStatusCode(),
                            'http_referrer_id' => $parsed->getReferrer(),
                            'bytes_sent' => $parsed->getBytes(),
                            'created_at' => $parsed->getTimeStamp()
                        ]
                    );

                    $log->update(['import_status_id' => ImportStatus::SUCCESS, 'processed_at' => now()]);
                }, function () use ($log) {
                    $log->update(['import_status_id' => ImportStatus::FAILURE]);
                });
            });
        });

        return Command::SUCCESS;
    }
}
