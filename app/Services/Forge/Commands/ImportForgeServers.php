<?php

namespace App\Services\Forge\Commands;

use App\Services\Forge\LaravelForge;
use App\Services\Forge\Models\ImportForgeServers as ModelsImportForgeServers;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

class ImportForgeServers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'wtk:import-forge-servers';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import Provisioned Servers from Laravel Forge';

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
        $servers = $client->getServers();

        $importGroupId = Str::uuid();

        $this->info('Importing Laravel Forge Servers : ' . $importGroupId);

        collect($servers)->each(function ($server) use ($importGroupId) {
            rescue(function () use ($server, $importGroupId) {
                ModelsImportForgeServers::create(
                    [
                        'import_group_id' => $importGroupId,
                        'data' => collect($server)
                    ]
                );
            });
        });

        return Command::SUCCESS;
    }
}
