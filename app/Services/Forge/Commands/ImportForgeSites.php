<?php

namespace App\Services\Forge\Commands;

use App\Services\Forge\LaravelForge;
use App\Services\Forge\Models\ForgeServer;
use App\Services\Forge\Models\ImportForgeSites as ModelsImportForgeSites;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

class ImportForgeSites extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'wca:import-forge-sites';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import Deployed Sites from Laravel Forge';

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
        $client = new LaravelForge();

        $servers = ForgeServer::orderBy('forge_server_id')->get();
        $importGroupId = Str::uuid();

        $this->info('Importing Laravel Forge Sites : ' . $importGroupId);

        collect($servers)->each(function ($server) use ($client, $importGroupId) {
            rescue(function () use ($client, $server, $importGroupId) {
                $sites = $client->getSites($server->source_id);

                ModelsImportForgeSites::create(
                    [
                        'import_group_id' => $importGroupId,
                        'forge_server_id' => $server->source_id,
                        'data' => collect($sites)
                    ]
                );
            });
        });

        return Command::SUCCESS;
    }
}
