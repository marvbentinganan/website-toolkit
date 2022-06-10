<?php

namespace App\Services\Datadog\Commands;

use App\Services\Datadog\Datadog;
use App\Services\Datadog\Models\ImportDatadogHost;
use Illuminate\Console\Command;
use Illuminate\Support\Str;

class ImportDatadogHosts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'wca:import-datadog-hosts';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Import Infrastructure information from Datadog';

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
        $datadog = new Datadog();

        $data = $datadog->getInfrastructure();
        $importGroupId = Str::uuid();

        $this->info('Importing Datadog Hosts : ' . $importGroupId);

        collect($data->host_list)->each(function ($host) use ($importGroupId) {
            rescue(function () use ($host, $importGroupId) {
                ImportDatadogHost::create([
                    'import_group_id' => $importGroupId,
                    'data' => collect($host)
                ]);
            });
        });

        return Command::SUCCESS;
    }
}
