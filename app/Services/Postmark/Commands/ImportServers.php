<?php

namespace App\Services\Postmark\Commands;

use App\Services\Postmark\Models\ImportPostmarkServer;
use App\Services\Postmark\Postmark;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class ImportServers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'wtk:import-postmark-servers';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import servers from Postmark';

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
        $data = $postmark->getAccountsServers();
        $importGroupId = Str::uuid();
        $this->info('Importing PostmarkServers : ' . $importGroupId);

        collect($data->Servers)->map(function ($data) use ($importGroupId) {
            $this->cacheServerKey($data->ID, $data->ApiTokens[0]);

            return [
                'import_group_id' => $importGroupId,
                'postmark_name' => $data->Name,
                'source_server_id' => $data->ID,
                'created_at' => now(),
                'updated_at' => now(),
            ];
        })->chunk(100)->each(function ($data) {
            ImportPostmarkServer::insert($data->toArray());
        });


        return 0;
    }

    private function cacheServerKey($serverId, $key)
    {
        Cache::remember('postmark.' . $serverId, now()->addDays(30), function () use ($key) {
            return $key;
        });
    }
}
